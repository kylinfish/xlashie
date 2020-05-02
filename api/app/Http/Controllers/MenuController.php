<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Forms\MenuForm;
use App\Services\MenuService;
use App\Repositories\MenuRepository;
use App\Models\Shop;

class MenuController extends Controller
{
    public function __construct(MenuRepository $menu_repo, MenuForm $form, MenuService $service)
    {
        // hardcode should be instead of real query
        $this->shop_id = Shop::find(1)->first()->id;
        $this->form = $form;
        $this->repo = $menu_repo;
        $this->service = $service;
        $this->service->setShopId($this->shop_id);
    }

    public function index(Request $request)
    {
        $menus = $this->service->getMenuSets($this->shop_id);

        return response()->json($menus, 200);
    }

    public function show(Request $request)
    {
        $this->form->validate(['uuid' => $menu_uuid]);

        $menu = $this->repo->getMenu($this->user_id, $menu_uuid);

        return response()->json(['data' => $menu], 200);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "price", "sub_contents"]);

        $this->form->validate($params);

        $menu = $this->service->createMenu($params);

        return response()->json(['message' => "菜單新增成功"], 200);
    }
}
