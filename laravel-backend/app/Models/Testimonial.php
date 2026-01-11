<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_name_en',
        'author_name_ar',
        'author_role_en',
        'author_role_ar',
        'quote_en',
        'quote_ar',
        'avatar',
        'rating',
        'order',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get localized author name
     */
    public function getAuthorNameAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->author_name_ar : $this->author_name_en;
    }

    /**
     * Get localized author role
     */
    public function getAuthorRoleAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->author_role_ar : $this->author_role_en;
    }

    /**
     * Get localized quote
     */
    public function getQuoteAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->quote_ar : $this->quote_en;
    }
}
