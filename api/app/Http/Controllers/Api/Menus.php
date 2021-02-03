<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\MenuService;
use App\Http\Resources\MenuResource;

class Menus extends \App\Http\Controllers\Controller
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
