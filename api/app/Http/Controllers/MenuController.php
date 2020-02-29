<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Forms\MenuForm;
use App\Services\MenuService;
use App\Repositories\MenuRepository;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct(MenuRepository $menu_repo, MenuForm $form, MenuService $service)
    {
        // hardcode should be instead of real query
        $this->user_id = User::find(1)->first()->id;

        $this->form = $form;
        $this->service = $service;
        $this->repo = $menu_repo;
    }

    public function index(Request $request)
    {
        $this->form->validate($request->all());

        $params["user_id"] = $this->user_id;

        $menus = $this->repo->getMenus($this->user_id, $request->all());

        return response()->json($menus, 200);
    }

    public function show(Request $request, string $menu_uuid)
    {
        $this->form->validate(['uuid' => $menu_uuid]);

        $menu = $this->repo->getMenu($this->user_id, $menu_uuid);

        return response()->json(['data' => $menu], 200);
    }
}
