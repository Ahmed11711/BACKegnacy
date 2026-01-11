<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutStat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'label_en',
        'label_ar',
        'value',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get localized label
     */
    public function getLabelAttribute($locale = 'en')
    {
        return $locale === 'ar' ? $this->label_ar : $this->label_en;
    }
}
