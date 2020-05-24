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
    public function getProduct(int $shop_id, int $product_id)
    {
        return $this->model->where([
            'id' => $product_id,
            'company_id' => $shop_id
        ])->first();
    }

    /**
     * getProducts
     *
     * @param int $shop_id
     */
    public function getProducts(int $shop_id)
    {
        return $this->model->where(["company_id" => $shop_id])->paginate(20);
    }

    public function getProductsByIds(int $shop_id, array $product_ids)
    {
        return $this->model->where(["company_id" => $shop_id])->whereIn("id", $product_ids);
    }

    public function deleteMyProduct(int $shop_id, int $product_id)
    {
        $this->model->where(["id" => $product_id, "company_id" => $shop_id])->delete();
    }
}
