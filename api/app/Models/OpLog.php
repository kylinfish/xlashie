<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpLog extends Model
{
    public const CONTROL_MAP = [
        "IndexController" => 1,
        "CompanyController" => 2,
        "CustomerController" => 3,
        "Api\Customers" => 4,
        "MenuController" => 5,
        "Api\Menus" => 6,
        "TicketController" => 7,
        "Api\Transactions" => 8,
        "Api\Invnotes" => 9,
        "Api\Inventories" => 10,
    ];

    public const CONTROL_MAP_FOR_HUMAN = [
        1 => "首頁",
        2 => "公司",
        3 => "客戶",
        4 => "客戶",
        5 => "營業項目",
        6 => "營業項目",
        7 => "訂單交易",
        8 => "訂單交易",
        9 => "庫存筆記",
        10 => "客戶商品庫存",
    ];


    public const ACTION_MAP = [
        "index" => 0,
        "show" => 1,
        "create" => 2,
        "store" => 3,
        "edit" => 4,
        "update" => 5,
        "delete" => 6,
        "destroy" => 7,
        "search" => 8,
        "detail" => 9,
        "upload" => 10,
    ];

    public const ACTION_MAP_FOR_HUMAN = [
        0 => "瀏覽",
        1 => "查看",
        2 => "建立",
        3 => "建立",
        4 => "修改",
        5 => "更新",
        6 => "刪除",
        7 => "刪除",
        8 => "查詢",
        9 => "查看細節",
        10 => "上傳",
    ];

    protected $table = "op_logs";

    protected $fillable = [
        'company_id',
        'user_id',
        'controller',
        'action',
        'sth',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        "sth" => ''
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
