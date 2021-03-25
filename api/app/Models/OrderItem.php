<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";

    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'unit_price',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attributes = [];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'order_id', 'id');
    }
}
