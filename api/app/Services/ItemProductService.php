<?php
namespace App\Services;

use Cache;
use App\Repositories\ItemProductRepository;

class ItemProductService
{
    public function __construct(ItemProductRepository $repo)
    {
        $this->repo = $repo;
    }
}
