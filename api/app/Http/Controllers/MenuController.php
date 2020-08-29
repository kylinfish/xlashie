<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Forms\MenuForm;
use App\Services\MenuService;
use App\Repositories\MenuRepository;
use App\Models\Company;

class MenuController extends Controller
{
    public function __construct(MenuRepository $menu_repo, MenuForm $form, MenuService $service)
    {
        $this->company_id = user()->company->first()->id;
        $this->form = $form;
        $this->repo = $menu_repo;
        $this->service = $service;
        $this->service->setCompanyId($this->company_id);
    }

    public function index(Request $request)
    {
        $menus = $this->service->getMenuSets($this->company_id);

        return view('menus.index', ['menus' => $menus]);
    }

    public function show(Request $request, String $menu_id)
    {
        $this->form->validate(['uuid' => $menu_id]);

        $menu = $this->repo->getMenu($menu_id, $this->company_id);

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