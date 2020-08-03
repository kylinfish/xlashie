<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Http\Resources\CustomerInventoryResource;


class Inventories extends BaseController
{
    public function __construct()
    {
        $this->user_id = user()->id;
    }

    public function index(Request $request, string $customer_uuid)
    {
        
        $customer = Customer::where(["user_id" => $this->user_id, "uuid" => $customer_uuid])->first();
        if (!$customer) {
            return [];
        }
        return CustomerInventoryResource::collection($customer->inventory()->orderBy('created_at', 'desc')->get());
    }
}