<?php

namespace App\Transformers;

use App\Models\Product as Model;
use League\Fractal\TransformerAbstract;

class Product extends TransformerAbstract
{
    /**
     * @param  Model $model
     * @return array
     */
    public function transform(Model $model)
    {
        return [
            'id' => $model->id,
            'sku' => $model->sku,
            'name' => $model->name,
            'description' => $model->description,
            'sale_price' => $model->sale_price,
            'purchase_price' => $model->purchase_price,
            'category_id' => $model->category_id,
            'quantity' => $model->quantity,
            'avatar' => $model->avatar,
            'status' => (integer) $model->status,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }

    /**
     * @param  Model $model
     * @return mixed
     */
    public function includeCategory(Model $model)
    {
        if (!$model->category) {
            return $this->null();
        }

        return $this->item($model->category, new Category());
    }
}
