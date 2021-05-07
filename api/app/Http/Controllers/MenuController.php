<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = my_comp()->menu->sortBy("id");

        return view('menus.index', compact('menus'));
    }

    public function show(Request $request, String $menu_id)
    {
        $menu = my_comp()->menu()->where('id', $menu_id)->first();

        return view('menus.show', ['menu' => $menu]);
    }

    public function update(Request $request, String $menu_id)
    {
        $params = $request->only(['name', 'price', 'description', 'init_status']);

        my_comp()->menu()->where('id', $menu_id)->first()->update([
            'name' => $params['name'],
            'price' => $params['price'],
            'init_status' => $params['init_status'],
        ]);

        $this->logging($request, $menu_id);

        return redirect('/menus/')->with(['alert' => 'success', 'message' => '更新成功']);
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'price', 'description', 'init_status']);

        $menu = my_comp()->menu()->create([
            'name' => $params['name'],
            'price' => $params['price'],
            'init_status' => $params['init_status'],
        ]);

        $this->logging($request, $menu->id);

        return redirect()->back()->with(['alert' => 'success', 'message' => "{$menu->name} 新增成功"]);
    }

    public function destroy(Request $request, String $menu_id)
    {
        if (!$menu = my_comp()->menu()->where('id', $menu_id)->first()) {
            return redirect('/menus/')->with(['alert' => 'warning', 'message' => '你指定的商品 id 不存在']);
        }

        $menu->delete();

        $this->logging($request);

        return redirect()->back()->with(['alert' => 'success', 'message' => "項目 {$menu->name} 刪除成功"]);
    }
}
