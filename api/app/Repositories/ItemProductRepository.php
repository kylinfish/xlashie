<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\ItemProduct;

class ItemProductRepository extends EloquentRepository
{
    public function __construct(ItemProduct $item_product)
    {
        $this->model = $item_product;
    }

    public function getItemProduct(int $shop_id)
    {
        return $this->model->where(['shop_id' => $shop_id])->first();
    }

    public function getItemProductsByProduct_id(int $product_id)
    {
        return $this->model->where(["product_id" => $product_id])->paginate(20);
    }
}
