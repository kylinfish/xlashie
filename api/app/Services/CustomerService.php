<?php
namespace App\Services;

use Cache;
use Illuminate\Support\Str;
use App\Repositories\CustomerRepository;

class CustomerService
{
    public function __construct(CustomerRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createCustomer(array $data)
    {
        #XXX: Replace by PIXNET create method
        $data['uuid'] = Str::random(18);

        return $this->repo->create($data);
    }
}
