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
    public function getCustomers(int $user_id, array $params)
    {
        $per_page = $params["per_page"] ?? 20;

        $customers =  $this->model->where(["user_id" => $user_id])->paginate($per_page);

        return $customers->appends(['per_page' => $per_page]);
    }
}
