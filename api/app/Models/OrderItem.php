<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";

    protected $fillable = [
        'order_id',
        'product_name',
        'qnantity',
        'unit_price',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [];

    public function ticket()
    {
        return $this->hasOne('App\Models\Ticket', 'order_id', 'id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }
}
