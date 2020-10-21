<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Menu;
use App\Forms\MenuForm;
use App\Services\MenuService;

class MenuController extends Controller
{
    public function __construct()
    {
        // 要先有 Company 才能使用 Menu 功能
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->company) {
                return redirect('/company/create/?wizard=1');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $menus = user()->company->menu;

        $is_wizard = ($request->get('wizard') or $menus->count() < 1) ? true : false;

        return view('menus.index', compact('menus', 'is_wizard'));
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
