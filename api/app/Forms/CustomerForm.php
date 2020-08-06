<?php
namespace App\Forms;

use App\Forms\BaseForm;

class CustomerForm extends BaseForm
{
    protected $store = [
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'cellphone' => 'required|string|size:10',
        'email' => 'required|string|email|unique:customers,email|max:50',
        'gender' => 'numeric|max:2',
        'birth' => 'date',
        'avatar' => 'string|max:100',
        'note_1' => 'string',
        'note_2' => 'string',
    ];

    protected $update = [
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'cellphone' => 'required|string|size:10',
        'gender' => 'numeric|max:2',
        'birth' => 'date',
        'avatar' => 'string|max:100',
        'note_1' => 'string',
        'note_2' => 'string',
    ];

    protected $index = [
        'from'    => 'numeric',
        'limit'   => 'numeric',
    ];

    protected $show = [
        'uuid'    => 'required|string|size:18',
    ];
}
