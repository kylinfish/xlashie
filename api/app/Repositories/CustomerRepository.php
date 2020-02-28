<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Customer;

class CustomerRepository extends EloquentRepository
{
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    /**
     * getCustomer 取得單一客戶
     *
     * @param int $shop_id
     *
     * @return void
     */
    public function getCustomer(int $user_id, string $customer_uuid)
    {
        return $this->model->where(["user_id" => $user_id, "uuid" => $customer_uuid])->first();
    }

    /**
     * getCustomers 取得客戶列表
     *
     * @return void
     */
    public function getCustomers(int $user_id)
    {
        return $this->model->where(["user_id" => $user_id])->paginate(20);
    }
}
