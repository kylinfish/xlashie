<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Discount;

class DiscountRepository extends EloquentRepository
{
    public function __construct(Discount $discount)
    {
        $this->model = $discount;
    }

    /**
     * getDiscount
     *
     * @param int $company_id
     */
    public function getDiscount(int $company_id)
    {
        return $this->model->where(['company_id' => $company_id])->first();
    }

    /**
     * getDiscounts
     *
     * @param int $company_id
     */
    public function getDiscounts(int $company_id)
    {
        return $this->model->where(["company_id" => $company_id])->paginate(20);
    }
}
