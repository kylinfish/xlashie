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
        return MenuResource::collection(user()->company->menu);
    }
}
