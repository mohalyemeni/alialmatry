<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\User;

class UsefulLink extends Model
{
    use HasFactory, Sluggable, SoftDeletes, SearchableTrait;

    protected $fillable = [
        'title',
        'slug',
        'url',
        'meta_keywords',
        'meta_description',
        'meta_slug',
        'published_on',
        'created_by',
        'updated_by',
        'views',
        'status',
    ];


    protected $searchable = [
        'columns' => [
            'useful_links.title' => 10,
            'useful_links.url' => 5,
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
                'source' => 'title',
            ],
        ];
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
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