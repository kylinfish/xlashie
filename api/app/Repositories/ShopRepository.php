<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Shop;

class ShopRepository extends EloquentRepository
{
    public function __construct(Shop $shop)
    {
        $this->model = $shop;
    }
}