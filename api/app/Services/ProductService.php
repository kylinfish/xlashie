<?php
namespace App\Services;

use Cache;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }
}
