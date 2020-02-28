<?php
namespace App\Forms;

use App\Forms\BaseForm;

class CustomerForm extends BaseForm
{
    protected $store = [
        #'member_uniqid' => 'required|max:18',
        #'user_id' => 'required|integer|max:50',
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'email' => 'required|string|email|unique:customers,email|max:50',
        'gender' => 'numeric|max:2',
        'birth' => 'date',
        'avatar' => 'string|max:100',
        'line' => 'string|max:30',
        'fb' => 'string|max:30',
        'note' => 'string',
    ];

    protected $index = [
        'from'    => 'numeric',
        'limit'   => 'numeric',
    ];

    protected $show = [
        'uuid'    => 'required|string|size:18',
    ];
}
