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
        'payment',
        'discount',
        'price',
        'note',
        'created_at',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attributes = [];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    // phpcs:disable PSR1.Methods.CamelCapsMethodName
    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // phpcs:disable PSR1.Methods.CamelCapsMethodName
    public function customer_inventory()
    {
        return $this->hasMany(CustomerInventory::class, 'order_id', 'id');
    }
}
