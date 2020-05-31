<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Company;

class CompanyRepository extends EloquentRepository
{
    public function __construct(Company $company)
    {
        $this->model = $company;
    }
}