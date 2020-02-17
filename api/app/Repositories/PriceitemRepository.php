<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Priceitem;

class PriceitemRepository extends EloquentRepository
{
    public function __construct(Priceitem $priceitem)
    {
        $this->model = $priceitem;
    }

    /**
     * getPriceitem
     *
     * @param int $shop_id
     *
     * @return void
     */
    public function getPriceitem(int $shop_id)
    {
        return $this->model->where(['shop_id' => $shop_id])->first();
    }

    /**
     * getPriceitems
     *
     * @param int $shop_id
     *
     * @return void
     */
    public function getPriceitems(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])->paginate(20);
    }
}
