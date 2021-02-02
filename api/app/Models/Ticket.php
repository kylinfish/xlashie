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

    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
