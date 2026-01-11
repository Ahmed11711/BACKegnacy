<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'category_key',
        'image',
        'images',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
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
