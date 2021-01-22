<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Transformers\Customer as Transformer;

class OrderController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $limit = request('limit', 20);
        $orders = Ticket::where("company_id", auth()->user()->company->id)->orderBy("id", "DESC")->with('Customer')->get();
        $orders = $this->paginate($orders, $limit);

        return view("orders.index", compact("orders"));
    }
}
