<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\User;

class Book extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'img',
        'file',
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
            'books.title' => 10,
            'books.description' => 10,
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

        static::creating(function ($book) {
            if (auth()->check()) {
                $book->created_by = auth()->id();
            }
        });

        static::updating(function ($book) {
            if (auth()->check()) {
                $book->updated_by = auth()->id();
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
