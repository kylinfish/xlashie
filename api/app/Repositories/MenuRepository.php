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

    public function getMenu(int $id, int $company_id)
    {
        return $this->model->where(["id" => $id, "company_id" => $company_id])->first();
    }

    public function getMenuSets(int $company_id)
    {
        return $this->model->where(["company_id" => $company_id])
            ->with([
                "sub_menus",
                "product",
                "sub_menus.product"
            ])->orderBy("created_at", "DESC")->paginate(20);
    }
}
