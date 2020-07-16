<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\OrderItem;

class OrderItemRepository extends EloquentRepository
{
    public function __construct(OrderItem $order_item)
    {
        $this->model = $order_item;
    }
}