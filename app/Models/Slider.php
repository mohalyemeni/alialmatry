<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Slider extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

protected $casts = [
    'title' => 'array',
    'subtitle' => 'array',
    'description' => 'array',
    'btn_title' => 'array',
    'url' => 'array',
    'metadata_title' => 'array',
    'metadata_description' => 'array',
    'metadata_keywords' => 'array',
    'published_on' => 'datetime',
    'status' => 'boolean',
    'show_btn_title' => 'boolean',
];

    protected $searchable = [
        'columns' => [
            'sliders.title' => 10,
            'sliders.description' => 10,
        ]
    ];

    public function getRouteKeyName()
    {

        return 'slug';
    }

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeMainSliders($query)
    {
        return $query->whereSection(1);
    }

    public function scopeAdvertisorSliders($query)
    {
        return $query->whereSection(2);
    }

    public function generateSlugFromTitle(): string
    {
        $title = $this->title;

        if (is_array($title)) {
            $value = $title['ar'] ?? $title['en'] ?? reset($title);
        } else {
            $value = $title;
        }

        $value = $value ?? 'slider-' . uniqid();

        return MySlugHelper::slug(strip_tags((string) $value));
    }

    protected static function booted()
    {
        static::creating(function ($slider) {

            if (empty($slider->slug)) {
                $slider->slug = $slider->generateSlugFromTitle();
            } else {
                $slider->slug = MySlugHelper::slug((string) $slider->slug);
            }

            $base = $slider->slug;
            $i = 1;
            while (static::where('slug', $slider->slug)->exists()) {
                $slider->slug = $base . '-' . time() . '-' . $i;
                $i++;
            }
        });

        static::updating(function ($slider) {
            if (empty($slider->slug)) {
                $slider->slug = $slider->generateSlugFromTitle();
            } else {
                $slider->slug = MySlugHelper::slug((string) $slider->slug);
            }
        });
    }
}