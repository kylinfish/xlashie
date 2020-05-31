<?php
namespace App\Services;

use Cache;
use App\Repositories\ProductRepository;

class ProductService
{
    private $company_id;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function setCompanyId(int $id)
    {
        $this->company_id = $id;
    }

    public function createProduct(array $data)
    {
        $data["company_id"] = $this->company_id;
        return $this->repo->create($data);
    }

    /**
     * checkProductsOwner 檢查產品是否屬於該店家擁有的
     */
    public function checkProductsOwner(int $company_id, array $product_ids)
    {
        $products_count = $this->repo->getProductsByIds($company_id, $product_ids)->count();

        return $products_count == count($product_ids);
    }
}
