<?php
namespace App\Forms;

use App\Forms\BaseForm;

class ProductForm extends BaseForm
{
    protected $store = [
        'name' => 'required|string|max:50',
        'avatar' => 'required|string|max:255',
        'cost' => 'required|numeric|min:0|not_in:0',
        'price' => 'required|numeric|min:0|not_in:0',
        'status' => 'integer|max:2',
    ];

    protected $index = [
        'from'    => 'numeric',
        'limit'   => 'numeric',
    ];

    protected $show = [
        'uuid'    => 'required|string|size:18',
    ];
}
