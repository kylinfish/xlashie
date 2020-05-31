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
     * @param int $company_id
     */
    public function getProduct(int $company_id, int $product_id)
    {
        return $this->model->where([
            'id' => $product_id,
            'company_id' => $company_id
        ])->first();
    }

    /**
     * getProducts
     *
     * @param int $company_id
     */
    public function getProducts(int $company_id)
    {
        return $this->model->where(["company_id" => $company_id])->paginate(20);
    }

    public function getProductsByIds(int $company_id, array $product_ids)
    {
        return $this->model->where(["company_id" => $company_id])->whereIn("id", $product_ids);
    }

    public function deleteMyProduct(int $company_id, int $product_id)
    {
        $this->model->where(["id" => $product_id, "company_id" => $company_id])->delete();
    }
}
