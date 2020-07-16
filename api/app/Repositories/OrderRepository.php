<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Order;

class OrderRepository extends EloquentRepository
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getOrders(int $company_id, int $customer_id)
    {
        return $this->model->where([
            "company_id" => $company_id,
            "customer_id"=> $customer_id,
        ])->orderBy("created_at", "DESC")->get();
    }
}
