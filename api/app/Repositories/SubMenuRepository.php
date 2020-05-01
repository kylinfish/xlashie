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

    public function getSubMenus(int $menu_id)
    {
        return $this->model->where(["menu_id" => $menu_id]);
    }

    public function getSubMenusByMenuId(array $menu_ids)
    {
        return $this->model->whereIn("menu_id", $menu_ids)->paginate(20);
    }
}
