<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'page_content';

    protected $fillable = [
        'page_key',
        'section_key',
        'content_en',
        'content_ar',
        'type',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get localized content
     */
    public function getContentAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->content_ar : $this->content_en;
    }

    /**
     * Scope for specific page
     */
    public function scopeForPage($query, $pageKey)
    {
        return $query->where('page_key', $pageKey);
    }

    /**
     * Scope for specific section
     */
    public function scopeForSection($query, $sectionKey)
    {
        return $query->where('section_key', $sectionKey);
    }
}
