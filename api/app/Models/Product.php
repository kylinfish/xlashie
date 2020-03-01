<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'shop_id',
        'name',
        'avatar',
        'cost',
        'price',
        'status',
        'category_id',
        'inventory_count',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [
        'name'   => '',
        'avatar' => '',
    ];
}
