<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Forms\CustomerForm;
use App\Http\Resources\CustomerResource;


class Customers extends BaseController
{
    public function __construct()
    {
        $this->user_id = user()->id;
    }

    public function index()
    {
        return CustomerResource::collection(Customer::where("user_id", $this->user_id));
    }

    public function show(Request $request, string $customer_uuid)
    {
        $customer = Customer::where(["user_id" => $this->user_id,"uuid" => $customer_uuid])->first();
        if (!$customer) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return new CustomerResource($customer);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "phone", "email",  "birth", "note1", "note2"]);

        $this->form->validate($params);

        $params["user_id"] = $this->user_id;

        $customer = $this->service->createCustomer($params);

        return response()->json(["message" => "ok"], 200);
    }

    public function update(Request $request, CustomerForm $form, string $customer_uuid)
    {
        // Email 暫時不提供修改
        $params = $request->only(["name", "phone", "cellphone", "gender", "address", "birth", "note_1", "note_2"]);

        $form->validate($params);

        if (! $customer = Customer::where("uuid", $customer_uuid)->first()) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->update($params);

        return response()->json(["message" => "ok"], 200);
    }
}