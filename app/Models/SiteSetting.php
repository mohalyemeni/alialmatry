<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class SiteSetting extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $guarded = [];

    // نحتفظ بالـ casts للحقل status و published_on
    protected $casts = [
        'status' => 'boolean',
        'published_on' => 'datetime',
    ];

    /**
     * Accessor عمومي لحقل value:
     * - لو القيمة مخزنة كـ JSON سيتم إرجاعها كمصفوفة (associative)
     * - لو كانت نصًا عاديًا سيتم إرجاعها كنص
     */
    public function getValueAttribute($value)
    {
        // إذا كانت القيمة فارغة
        if ($value === null) {
            return null;
        }

        // حاول فك JSON
        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // ليس JSON => أرجع النص كما هو
        return $value;
    }

    /**
     * Mutator لحقل value:
     * - إذا أعطيته مصفوفة أو كائن، سيُخزن كـ JSON
     * - إذا أعطيته نصًا سيخزَّن نصًا (حتى لو العمود json، Laravel/MySQL سيحاول تخزينه)
     */
    public function setValueAttribute($value)
    {
        if (is_array($value) || is_object($value)) {
            $this->attributes['value'] = json_encode($value, JSON_UNESCAPED_UNICODE);
            return;
        }

        // نص أو رقم أو null
        $this->attributes['value'] = $value;
    }

    protected $searchable = [
        'columns' => [
            'site_settings.key' => 10,
        ]
    ];

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(\App\Models\Photo::class, 'imageable');
    }

    public function firstMedia(): MorphOne
    {
        return $this->morphOne(\App\Models\Photo::class, 'imageable')->orderBy('file_sort', 'asc');
    }

    public function lastMedia(): MorphOne
    {
        return $this->morphOne(\App\Models\Photo::class, 'imageable')->orderBy('file_sort', 'desc');
    }
}