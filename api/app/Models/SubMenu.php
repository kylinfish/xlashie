<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    public $timestamps = true;

    protected $table = "sub_menus";

    protected $fillable = ['name', 'amount', 'order', 'product_id', "menu_id"];

    protected $hidden = ['id'];

    protected $guarded = [];

    protected $attrubutes = [];
}
