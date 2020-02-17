<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Product;

class ProductRepository extends EloquentRepository
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * getCustomer
     *
     * @param int $shop_id
     */
    public function getProduct(int $shop_id)
    {
        return $this->model->where(['shop_id' => $shop_id])->first();
    }

    /**
     * getProducts
     *
     * @param int $shop_id
     */
    public function getProducts(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])->paginate(20);
    }
}
