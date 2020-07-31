<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'customer_id',
        'company_id',
        'ticket',
        'pay_type',
        'discount',
        'purchase_price',
        'note'
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [];

    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }
}
