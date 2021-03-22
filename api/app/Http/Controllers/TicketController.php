<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $limit = request('limit', 20);
        $orders = my_comp()->ticket()->orderBy('id', 'desc')
            ->with('customer')
            ->with("order_items")
            ->get();
        $orders = $this->paginate($orders, $limit);

        return view("orders.index", compact("orders"));
    }
}
