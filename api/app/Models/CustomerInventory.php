<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInventory extends Model
{
    const STATUS_UNUSED = 0; // 未使用
    const STATUS_DONE = 1; // 已發放
    const STATUS_USED = 2;  // 已使用
    const STATUS_OWED = 3; // 積欠
    const STATUS_CANCLED = 4; // 註銷

    protected $table = "customer_inventories";

    protected $fillable = [
        'customer_id',
        'company_id',
        'product_name',
        'status',
        'create_at',
        'use_at',
        'note',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [];

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
}
