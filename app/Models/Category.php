<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $table = 'categories';
    protected $guarded = [];

    protected $casts = [
        'deleted_at'   => 'datetime',
        'published_on' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',

        'featured'     => 'boolean',
        'status'       => 'boolean',
    ];

    const SECTION_VIDEO   = 1;
    const SECTION_AUDIO   = 2;
    const SECTION_FATWA   = 3;
    const SECTION_ARTICLE = 4;

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function videos()  { return $this->hasMany(\App\Models\Video::class,  'category_id'); }
    public function audios()  { return $this->hasMany(\App\Models\Audio::class,  'category_id'); }
    public function fatawas() { return $this->hasMany(\App\Models\Fatwa::class,  'category_id'); }
    public function blogs()   { return $this->hasMany(\App\Models\Blog::class,   'category_id'); }

    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (Auth::check()) $category->created_by = Auth::id();
        });

        static::updating(function ($category) {
            if (Auth::check()) $category->updated_by = Auth::id();
        });
    }


    public function scopeVideos($q)   { return $q->where('section', self::SECTION_VIDEO); }
    public function scopeAudios($q)   { return $q->where('section', self::SECTION_AUDIO); }
    public function scopeFatwas($q)   { return $q->where('section', self::SECTION_FATWA); }
    public function scopeArticles($q) { return $q->where('section', self::SECTION_ARTICLE); }


    public function scopeFeatured($q, $isFeatured = true)
    {
        return $q->where('featured', $isFeatured ? 1 : 0);
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeInSection($q, $section)
    {
        return $q->where('section', $section);
    }
}