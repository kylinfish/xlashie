<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Company;
use App\Services\MenuService;
use App\Http\Resources\MenuResource;

class Menus extends BaseController
{
    public function __construct(MenuService $service)
    {
        # Now: use and company is the one-one relation, we can adjust user belongsToMany in the future
        $this->user_id = user()->id;
        $this->company_id = user()->company->first()->id;
        $this->service = $service;
        $this->service->setCompanyId($this->company_id);
    }


    public function index(Request $request)
    {
        $menus = Menu::where(["company_id" => $this->company_id])
            ->with(["sub_menus", "product", "sub_menus.product"])
            ->orderBy("created_at", "DESC");
        return MenuResource::collection($menus->get());
    }

    public function show(Request $request, String $menu_id)
    {
        $this->form->validate(['uuid' => $menu_id]);
        
        $menu = Menu::where(["company_id" => $this->company_id, "id" => $menu_id])
            ->with(["sub_menus", "product", "sub_menus.product"])->first();
        if (!$menu) {
            return response()->json(["message" => "找不到該菜單資訊"], 404);
        }

        return response()->json(['data' => $menu], 200);
    }

    public function store(Request $request)
    {
        $params = $request->only(["product_id", "sale_price", "sub_menus", "purchase_price", "name"]);

        $this->form->validate($params);

        $menu = $this->service->createMenu($params);

        return response()->json(['message' => "菜單新增成功"], 200);
    }
}
