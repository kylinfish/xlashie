<?php
namespace App\Forms;

use App\Forms\BaseForm;

class CustomerForm extends BaseForm
{
    protected $store = [
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'cellphone' => 'nullable|string|size:10',
        'email' => 'nullable|string|email|unique:customers,email|max:50',
        'gender' => 'numeric|max:2',
        'birth' => 'nullable|date',
        'avatar' => 'nullable|string|max:100',
        'note_1' => 'nullable|string',
        'note_2' => 'nullable|string',
    ];

    protected $update = [
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'cellphone' => 'nullable|string|size:10',
        'gender' => 'numeric|max:2',
        'birth' => 'nullable|date',
        'avatar' => 'nullable|string|max:100',
        'note_1' => 'nullable|string',
        'note_2' => 'nullable|string',
    ];

    protected $index = [
        'from'    => 'numeric',
        'limit'   => 'numeric',
    ];

    protected $show = [
        'uuid'    => 'required|string|size:18',
    ];
}
