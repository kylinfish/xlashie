<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Menu;
use App\Forms\MenuForm;
use App\Services\MenuService;

class MenuController extends Controller
{
    public function __construct(MenuForm $form, MenuService $service)
    {
        $this->form = $form;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $menus = Menu::where(["company_id" => user()->company_id])->with([
                "sub_menus",
                "product",
                "sub_menus.product"
            ])->orderBy("id", "asc")->get();


        return view('menus.index', ['menus' => $menus]);
    }

    public function show(Request $request, String $menu_id)
    {
        $this->form->validate(['uuid' => $menu_id]);

        $menu = Menu::where(['id' => $menu_id, 'company_id' => user()->company_id])->first();

        return response()->json(['data' => $menu], 200);
    }

    public function store(Request $request)
    {
        $params = $request->only(["product_id", "sale_price", "sub_menus", "purchase_price", "name"]);

        $this->form->validate($params);

        $menu = $this->service->createMenu(user()->company_id, $params);

        return response()->json(['message' => "菜單新增成功"], 200);
    }
}