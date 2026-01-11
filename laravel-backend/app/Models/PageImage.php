<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_key',
        'image_key',
        'image_path',
        'alt_text_en',
        'alt_text_ar',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get localized alt text
     */
    public function getAltTextAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->alt_text_ar : $this->alt_text_en;
    }

    /**
     * Scope for specific page
     */
    public function scopeForPage($query, $pageKey)
    {
        return $query->where('page_key', $pageKey);
    }

    /**
     * Scope for specific image key
     */
    public function scopeForImageKey($query, $imageKey)
    {
        return $query->where('image_key', $imageKey);
    }
}
