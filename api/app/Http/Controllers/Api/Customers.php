<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;


class Customers extends BaseController
{
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    public function show(Request $request, string $customer_uuid)
    {
        return Customer::where(["uuid" => $customer_uuid])->first()->toArray();
    }
}