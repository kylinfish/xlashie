<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = "sub_menus";

    protected $fillable = ['name', 'amount', 'order', 'product_id', "item_id"];

    protected $hidden = ['id'];

    protected $guarded = [];

    protected $attrubutes = [];
}
