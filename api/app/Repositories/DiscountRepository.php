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
     * @param int $shop_id
     */
    public function getDiscount(int $shop_id)
    {
        return $this->model->where(['shop_id' => $shop_id])->first();
    }

    /**
     * getDiscounts
     *
     * @param int $shop_id
     */
    public function getDiscounts(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])->paginate(20);
    }
}
