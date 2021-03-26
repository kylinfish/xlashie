<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {
        $customer_count = my_customer()->count();
        $menu_count = my_comp()->menu()->count();
        $ticket_count = my_comp()->ticket()->count();

        $recently_tickets = [];
        $recently_tickets = my_comp()->ticket()->with("customer")
            ->orderBy("created_at", "DESC")->limit(5)->get();



        return view("welcome", compact("customer_count", "menu_count", "ticket_count", "recently_tickets"));
    }

    public function landing()
    {
        return view("landing");
    }
}
