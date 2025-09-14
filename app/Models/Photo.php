<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    protected $guarded = [];

      protected $casts = [
        'file_status' => 'boolean'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function booted()
    {
        static::deleting(function ($siteSetting) {
            if ($siteSetting->photos) {
                $siteSetting->photos()->delete();
            }
        });
    }

}