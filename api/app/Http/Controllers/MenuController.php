<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Menu;
use App\Forms\MenuForm;
use App\Services\MenuService;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = user()->company->menu;

        return view('menus.index', ['menus' => $menus]);
    }

    public function show(Request $request, String $menu_id)
    {
        $menu = user()->company->menu->where('id', $menu_id)->first();

        return view('menus.show', ['menu' => $menu]);
    }

    public function update(Request $request, String $menu_id)
    {
        $params = $request->only(['name', 'price', 'description', 'init_status']);

        user()->company->menu->where('id', $menu_id)->first()->update([
            'name' => $params['name'],
            'price' => $params['price'],
            'init_status' => $params['init_status'],
            'description' => $params['description'] ?? '',
        ]);

        return redirect('/menus/')->with(['alert' => 'success', 'message' => '更新成功']);
    }

    public function store(Request $request, MenuService $service)
    {
        $params = $request->only(['name', 'price', 'description', 'init_status']);

        $menu = Menu::create([
            'company_id' => user()->company->id,
            'name' => $params['name'],
            'price' => $params['price'],
            'init_status' => $params['init_status'],
            'description' => $params['description'] ?? '',
        ]);

        return redirect()->back()->with(['alert' => 'success', 'message' => "{$menu->name} 新增成功"]);
    }

    public function destroy(Request $request, String $menu_id)
    {
        if (! $menu = user()->company->menu->where('id', $menu_id)->first()) {
            return redirect('/menus/')->with(['alert' => 'warning', 'message' => '你指定的商品 id 不存在']);
        }

        $menu->delete();
        return redirect()->back()->with(['alert' => 'success', 'message' => "項目 {$menu->name} 刪除成功"]);

    }
}
