<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\CustomerForm;
use App\Models\Ticket;
use App\Models\Customer;

class IndexController extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {
        $customer_count = my_customer()->count();

        $recently_tickets = [];
        $recently_tickets = my_comp()->ticket()->with("customer")
            ->orderBy("created_at", "DESC")->limit(8)->get();

        return view("welcome", compact("customer_count", "recently_tickets"));
    }
}
