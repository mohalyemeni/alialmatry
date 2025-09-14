<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use HasFactory,Sluggable, SoftDeletes;

    protected $table = 'audios';

    protected $guarded = [];

    protected $casts = [
        'published_on' => 'datetime',
        'status' => 'boolean',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

        public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
                    ->where('section', Category::SECTION_AUDIO);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audio) {
            if (auth()->check()) {
                $audio->created_by = auth()->id();
            }
        });

        static::updating(function ($audio) {
            if (auth()->check()) {
                $audio->updated_by = auth()->id();
            }
        });
    }
}
