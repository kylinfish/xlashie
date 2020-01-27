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
     * @param int $shop_id
     *
     * @return void
     */
    public function getCustomer(int $shop_id, string $customer_uuid)
    {
        return $this->model->where(["uuid" => $customer_uuid, "shop_id" => $shop_id])->first();
    }

    /**
     * getCustomers 取得客戶列表
     *
     * @param int $shop_id
     *
     * @return void
     */
    public function getCustomers(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])->paginate(20);
    }
}
