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
}