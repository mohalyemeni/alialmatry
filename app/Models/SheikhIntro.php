<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class SheikhIntro extends Model
{
    use HasFactory,  Sluggable,  SoftDeletes;

    protected $table = 'sheikh_intro';

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

        static::creating(function ($intro) {
            if (auth()->check()) {
                $intro->created_by = auth()->id();
            }
        });

        static::updating(function ($intro) {
            if (auth()->check()) {
                $intro->updated_by = auth()->id();
            }
        });
    }
}