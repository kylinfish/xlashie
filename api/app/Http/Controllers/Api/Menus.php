<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Menu;
use App\Services\MenuService;
use App\Http\Resources\MenuResource;

class Menus extends BaseController
{
    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $menus = Menu::where(["company_id" => user()->company_id])
            ->with(["sub_menus", "product", "sub_menus.product"])
            ->orderBy("created_at", "DESC");
        return MenuResource::collection($menus->get());
    }

    public function show(Request $request, String $menu_id)
    {
        $menu = Menu::where(["id" => $menu_id, "company_id" => user()->company_id])
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
