<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'orderable_type',
        'orderable_id',
        'name',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Get the parent orderable model (product or bundle)
     */
    public function orderable()
    {
        return $this->morphTo();
    }

    /**
     * Get order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
