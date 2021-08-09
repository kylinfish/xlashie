<?php

namespace App\Forms;

use App\Forms\BaseForm;

class OrderForm extends BaseForm
{
    protected $store = [
        'customer_id' => 'required|integer',
        'ticket' => 'required|string|max:10',
        'discount' => 'required|numeric|min:0|not_in:0',
        'purchase_price' => 'required|numeric|min:0|not_in:0',
        'pay_type' => 'required|string|max:10',
        'order_items' => 'required',
        'note' => 'string',
    ];

    protected $index = [
    ];

    protected $show = [
    ];
}
