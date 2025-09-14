<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\Category;
use App\Models\User;

class Video extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'youtube_id',
        'thumbnail',
        'category_id',
        'meta_keywords',
        'meta_description',
        'published_on',
        'created_by',
        'updated_by',
        'views',
        'status',
    ];

    protected $searchable = [
        'columns' => [
            'videos.title' => 10,
            'videos.description' => 10,
        ],
        'joins' => [
            'categories' => ['videos.category_id', 'categories.id'],
        ],
    ];

    protected $casts = [
        'published_on' => 'datetime',
        'status' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        // set created_by / updated_by automatically
        static::creating(function ($video) {
            if (Auth::check()) {
                $video->created_by = Auth::id();
            }
        });

        static::updating(function ($video) {
            if (Auth::check()) {
                $video->updated_by = Auth::id();
            }
        });



        // static::forceDeleted(function ($video) {
        //     try {
        //         if (! empty($video->thumbnail)) {
        //
        //             if (! Str::startsWith($video->thumbnail, ['http://', 'https://'])) {
        //                 if (Storage::disk('public')->exists($video->thumbnail)) {
        //                     Storage::disk('public')->delete($video->thumbnail);
        //                 } else {
        //
        //                     $attempt = 'videos/thumbnails/' . ltrim($video->thumbnail, '/');
        //                     if (Storage::disk('public')->exists($attempt)) {
        //                         Storage::disk('public')->delete($attempt);
        //                     }
        //                 }
        //             }
        //         }
        //     } catch (\Throwable $e) {
        //
        //         \Log::warning("Failed deleting video thumbnail for video_id={$video->id}: " . $e->getMessage());
        //     }
        // });

        /**

        /*
        static::deleted(function ($video) {
            try {
                if (! empty($video->thumbnail) && ! Str::startsWith($video->thumbnail, ['http://','https://'])) {
                    if (Storage::disk('public')->exists($video->thumbnail)) {
                        Storage::disk('public')->delete($video->thumbnail);
                    } else {
                        $attempt = 'videos/thumbnails/' . ltrim($video->thumbnail, '/');
                        if (Storage::disk('public')->exists($attempt)) {
                            Storage::disk('public')->delete($attempt);
                        }
                    }
                }
            } catch (\Throwable $e) {
                \Log::warning("Failed deleting video thumbnail on delete for video_id={$video->id}: " . $e->getMessage());
            }
        });
        */
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
                    ->where('section', Category::SECTION_VIDEO);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}