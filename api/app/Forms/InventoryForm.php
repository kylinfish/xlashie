<?php

namespace App\Forms;

use App\Forms\BaseForm;

class InventoryForm extends BaseForm
{
    protected $store = [
        'customer_id' => 'required|integer',
        'company_id' => 'required|integer',
        'product_name' => 'required|string|max:50',
        'status' => 'integer',
        'create_at' => 'datetime',
        'use_at' => 'datetime',
        'note' => 'string',
    ];

    protected $index = [
    ];

    protected $update = [
        'id' => 'required|integer',
        'status' => 'integer',
        'use_at' => 'date_format:Y-m-d\TH:i',
        'note' => 'nullable|string',
    ];
}
