<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_key',
        'meta_title_en',
        'meta_title_ar',
        'meta_description_en',
        'meta_description_ar',
        'meta_keywords_en',
        'meta_keywords_ar',
        'og_image',
    ];

    /**
     * Get localized meta title
     */
    public function getMetaTitleAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->meta_title_ar : $this->meta_title_en;
    }

    /**
     * Get localized meta description
     */
    public function getMetaDescriptionAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->meta_description_ar : $this->meta_description_en;
    }

    /**
     * Get localized meta keywords
     */
    public function getMetaKeywordsAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->meta_keywords_ar : $this->meta_keywords_en;
    }
}
