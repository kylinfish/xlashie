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
        $customer_count = Customer::where("user_id", auth()->user()->id)->count();

        $recently_tickets = [];
        if (auth()->user()->company) {
            $recently_tickets = Ticket::where("company_id", auth()->user()->company->id)->with("customer")
                ->orderBy("created_at", "DESC")->limit(8)->get();
        }

        return view("welcome", compact("customer_count", "recently_tickets"));
    }
}
