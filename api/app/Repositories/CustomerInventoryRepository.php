<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\CustomerInventory;

class CustomerInventoryRepository extends EloquentRepository
{
    public function __construct(CustomerInventory $c_inv)
    {
        $this->model = $c_inv;
    }

    public function getInventories(int $company_id, int $customer_id)
    {
        return $this->model->where([
            "company_id" => $company_id,
            "customer_id"=> $customer_id,
        ])->orderBy("created_at", "DESC")->get();
    }
}
