<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Fatwa extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $table = 'fatawas';

    protected $guarded = [];

    protected $casts = [
        'published_on' => 'datetime',
        'status' => 'boolean',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
                    ->where('section', Category::SECTION_FATWA);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

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

        static::creating(function ($fatwa) {
            if (auth()->check()) {
                $fatwa->created_by = auth()->id();
            }
        });

        static::updating(function ($fatwa) {
            if (auth()->check()) {
                $fatwa->updated_by = auth()->id();
            }
        });
    }


    public function getExcerptAttribute()
    {

        $source = $this->getRawAttributeValue('excerpt') ?? $this->getRawAttributeValue('description') ?? '';

        return $this->cleanAndLimit($source, 160);
    }

    /**
     *
     *
     * @param  string
     * @param  int
     * @return string
     */
    public function cleanAndLimit($text, $limit = 160)
    {

        $text = (string) $text;

        $decoded = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $stripped = strip_tags($decoded);

        $collapsed = trim(preg_replace('/\s+/u', ' ', $stripped));


        return Str::limit($collapsed, $limit);
    }


    public function getExcerpt($limit = 80)
    {
        $source = $this->getRawAttributeValue('excerpt') ?? $this->getRawAttributeValue('description') ?? '';
        return $this->cleanAndLimit($source, $limit);
    }


    protected function getRawAttributeValue(string $key)
    {
        return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;
    }
}