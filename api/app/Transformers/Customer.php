<?php

namespace App\Transformers;

use App\Models\Customer as Model;
use League\Fractal\TransformerAbstract;

class Customer extends TransformerAbstract
{
    /**
     * @param Model $model
     * @return array
     */
    public function transform(Model $model)
    {
        return [
            'uuid' => $model->uuid,
            'name' => $model->name,
            'phone' => $model->phone,
            'cellphone' => $model->cellphone,
            'email' => $model->email,
            'tax_number' => $model->tax_number,
            'address' => $model->address,
            'birth' => $model->birth,
            'gender' => $model->gender,
            'avatar' => $model->avatar,
            'line' => $model->line,
            'fb' => $model->fb,
            'note_1' => $model->note_1,
            'note_2' => $model->note_2,
            'discount_id' => $model->discount_id,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }
}
