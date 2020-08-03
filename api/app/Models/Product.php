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
        'company_id',
        'name',
        'avatar',
        'sale_price',
        'purchase_price',
        'status',
        'category_id',
        'quantity',
        'description',
        'sku',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [
        'name'   => '',
        'avatar' => '',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
