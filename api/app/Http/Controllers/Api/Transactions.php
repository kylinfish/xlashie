<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Services\TicketService;
use App\Http\Resources\TicketResource;
use App\Models\OrderItem;

class Transactions extends BaseController
{
    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, string $customer_uuid)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return TicketResource::collection($customer->ticket()->orderby("id", "desc")->get());
    }

    public function store(Request $request, string $customer_uuid)
    {
        $params = $request->only(["items", "ticket", "payment", "price", "transaction_at", "note"]);
        #TODO: order_items should be verified by the form.
        //$this->form->validate($params);

        $params["customer_uuid"] = $customer_uuid;
        $this->service->createOrder(user()->company_id, $params);

        return response()->json(["message" => "ok"], 200);
    }

    public function detail(Request $request, string $customer_uuid, string $id)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return $customer->ticket()->find($id)->order_items()->get();
    }
}