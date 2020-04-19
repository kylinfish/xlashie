<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //類型
    const TYPE_ENTITY = 1;
    const TYPE_VIRTUAL = 2;

    protected $table = "products";

    protected $fillable = [
        'shop_id',
        'name',
        'avatar',
        'cost', // 成本?
        'price', // 定價?
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
