<?php
namespace App\Forms;

use App\Forms\BaseForm;

class ProductForm extends BaseForm
{
    protected $store = [
        'name' => 'required|string|max:50',
        'sale_price' => 'required|numeric|min:0|not_in:0',
        'purchase_price' => 'required|numeric|min:0|not_in:0',
        'quantity' => 'integer',
    ];

    protected $index = [
        'from'    => 'numeric',
        'limit'   => 'numeric',
    ];

    protected $show = [
        'uuid'    => 'required|string|size:18',
    ];
}
