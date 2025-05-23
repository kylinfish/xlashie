<?php

namespace App\Forms;

use App\Forms\BaseForm;

class CustomerForm extends BaseForm
{
    protected $store = [
        'name' => 'required|string|max:20',
        'phone' => 'string|size:10',
        'cellphone' => 'nullable|string|size:10',
        'email' => 'nullable|string|email|unique:customers,email|max:50',
        'gender' => 'integer|min:0|max:2',
        'charged_by' => 'integer|min:0',
        'birth' => 'nullable|date',
        'avatar' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:150',
        'note_1' => 'nullable|string',
        'note_2' => 'nullable|string',
    ];

    protected $update = [
        'name' => 'required|string|max:20',
        'phone' => 'required|string|size:10',
        'cellphone' => 'nullable|string|size:10',
        'charged_by' => 'integer|min:0',
        'gender' => 'integer|min:0|max:2',
        'birth' => 'nullable|date',
        'avatar' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:150',
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

    protected $upload = [
        'file' => 'required|file|max:1024', // 10 MB
        'skip_head_line' => 'sometimes|boolean',
    ];

    public function getStoreRules()
    {
        return $this->store;
    }
}
