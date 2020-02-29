<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = "service_items";

    protected $fillable = ['shop_id', 'name', 'price', 'bonus', 'item_type'];

    protected $hidden = ['id'];
}
