<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomerInventory extends Model
{
    const STATUS_DEFAULT = -1; // 未使用
    const STATUS_UNUSED = 0; // 未使用
    const STATUS_DONE = 1; // 已發放
    const STATUS_USED = 2;  // 已使用
    const STATUS_OWED = 3; // 積欠
    const STATUS_CANCELED = 4; // 註銷

    protected $table = "customer_inventories";

    protected $fillable = [
        'customer_id',
        'company_id',
        'order_id',
        'note_id',
        'product_name',
        'status',
        'create_at',
        'use_at',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attributes = [];


    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    public static function getStatusWording(int $status)
    {
        $status_map = [
            CustomerInventory::STATUS_DEFAULT => "",
            CustomerInventory::STATUS_UNUSED => "未使用",
            CustomerInventory::STATUS_DONE => "已發放",
            CustomerInventory::STATUS_USED => "已使用",
            CustomerInventory::STATUS_OWED => "積欠未發",
            CustomerInventory::STATUS_CANCELED => "註銷失效",
        ];
        return $status_map[$status];
    }

    public function getUseAtAttribute($date)
    {
        return is_null($date) ? null : Carbon::parse($date);
    }

    public function note()
    {
        return $this->hasOne('App\Models\InvNote', 'note_id');
    }
}
