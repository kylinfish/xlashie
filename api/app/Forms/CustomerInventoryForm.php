<?php
namespace App\Forms;

use App\Forms\BaseForm;

class CustomerInventoryForm extends BaseForm
{
    protected $store = [
        'customer_id' => 'required|integer',
        'company_id' =>'required|integer',
        'product_name' => 'required|string|max:50',
        'status' => 'integer',
        'create_at' => 'datetime',
        'use_at' => 'datetime',
        'note' => 'string',
    ];

    protected $index = [
    ];

    protected $show = [
    ];
}
