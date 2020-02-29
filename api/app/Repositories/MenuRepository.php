<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Menu;

class MenuRepository extends EloquentRepository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getMenu(int $menu_id)
    {
        return $this->model->where(['id' => $menu_id])->first();
    }

    public function getMenus(int $shop_id)
    {
        return $this->model->where(["shop_id" => $shop_id])->paginate(20);
    }
}
