<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const ITEMTYPE_PURE_ITEM = 0;
    const ITEMTYPE_WITH_SUB_MENUS = 1;

    protected $table = "menus";

    protected $fillable = [];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [];

    public function sub_menu()
    {
        return $this->hasMany('App\Models\SubMenu', 'menu_id', 'id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
