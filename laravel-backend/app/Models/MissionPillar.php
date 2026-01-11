<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionPillar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get localized title
     */
    public function getTitleAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->title_ar : $this->title_en;
    }

    /**
     * Get localized description
     */
    public function getDescriptionAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->description_ar : $this->description_en;
    }
}
