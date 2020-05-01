<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Menu;

class MenuRepository extends EloquentRepository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;;
    }

    public function getMenu(int $id, int $shop_id)
    {
        return $this->model->where(["id" => $id, "shop_id" => $shop_id])->first();
    }

    public function getMenuSets(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])
            ->with("sub_menus")->paginate(20);
    }
}
