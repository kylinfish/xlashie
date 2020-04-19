<?php
namespace App\Services;

use Cache;
use App\Repositories\ProductRepository;

class ProductService
{
    private $shop_id;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function setShopId(int $id)
    {
        $this->shop_id = $id;
    }

    public function createProducts(Product $product, array $data)
    {
        foreach ($data as $entry) {
            $entry["shop_id"] = $this->shop_id;
            $this->itemproduct_repo->insert($entry);
        }
    }

    /**
     * checkProductsShopOwner 檢查產品是否屬於該店家擁有的
     */
    public function checkProductsOwner(int $shop_id, array $product_ids)
    {
        $products_count = $this->repo->getProductsByIds($shop_id, $product_ids)->count();

        return $products_count == count($product_ids);
    }
}
