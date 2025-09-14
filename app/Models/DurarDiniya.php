<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\User;

class DurarDiniya extends Model
{
    use HasFactory, Sluggable, SoftDeletes, SearchableTrait;

    protected $table = 'durar_diniya';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'img',
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
            'durar_diniya.title' => 10,
            'durar_diniya.description' => 10,
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

        static::creating(function ($durar) {
            if (auth()->check()) {
                $durar->created_by = auth()->id();
            }
        });

        static::updating(function ($durar) {
            if (auth()->check()) {
                $durar->updated_by = auth()->id();
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