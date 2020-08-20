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
        $this->user_id = user()->id;
        $this->company_id = user()->company->first()->id;
        $this->service = $service;
        $this->service->setCompanyId($this->company_id);
    }

    public function index(Request $request, string $customer_uuid)
    {
        $customer = Customer::where(["user_id" => $this->user_id, "uuid" => $customer_uuid])->first();
        if (!$customer) {
            return response()->json(["message" => "找不到該名顧客"], 404);
        }

        return TicketResource::collection($customer->ticket()->orderby("id", "desc")->get());
    }

    public function store(Request $request, string $customer_uuid)
    {
        $params = $request->only(["items", "ticket", "payment", "price", "transaction_at", "note"]);
        #TODO: order_items should be verified by the form.
        //$this->form->validate($params);

        $params["customer_uuid"] = $customer_uuid;
        $this->service->createOrder($params);

        return response()->json(["message" => "ok"], 200);
    }

    public function detail(Request $request, string $customer_uuid, string $id)
    {
        $customer = Customer::where(["user_id" => $this->user_id, "uuid" => $customer_uuid])->first();
        if (!$customer) {
            return response()->json(["message" => "找不到該名顧客"], 404);
        }
        $order_items = $customer->ticket()->find($id)->order_items()->get();
        return $order_items->toArray();
    }
}