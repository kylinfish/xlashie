<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpLog extends Model
{
    const CONTROL_MAP = [
        "IndexController" => 1,
        "CompanyController" => 2,
        "CustomerController" => 3,
        "Api\Customers" => 4,
        "MenuController" => 5,
        "Api\Menus" => 6,
        "TicketController" => 7,
        "Api\Transactions" => 8,
        "Api\InvNotes" => 9,
        "Api\Inventories" => 10,
    ];

    const ACTION_MAP = [
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
}
