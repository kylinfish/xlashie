<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\SubMenu;

class SubMenuRepository extends EloquentRepository
{
    public function __construct(SubMenu $sub_menu)
    {
        $this->model = $sub_menu;
    }

    public function getItemProduct(int $shop_id)
    {
        return $this->model->where(['shop_id' => $shop_id])->first();
    }

    public function getItemProductsByProduct_id(int $product_id)
    {
        return $this->model->where(["product_id" => $product_id])->paginate(20);
    }
}
