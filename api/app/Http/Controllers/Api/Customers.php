<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Forms\CustomerForm;
use App\Http\Resources\CustomerResource;


class Customers extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $limit = request('limit', 5);
        $customers = Customer::where("user_id", user()->id)->get();
        return CustomerResource::collection($this->paginate($customers, $limit));
    }

    public function show(Request $request, string $customer_uuid)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return new CustomerResource($customer);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "phone", "email",  "birth", "note1", "note2"]);

        $this->form->validate($params);

        $params["user_id"] = user()->id;

        $customer = $this->service->createCustomer($params);

        return response()->json(["message" => "ok"], 200);
    }

    public function update(Request $request, CustomerForm $form, string $customer_uuid)
    {
        // Email 暫時不提供修改
        $params = $request->only(["name", "phone", "cellphone", "gender", "address", "birth", "note_1", "note_2"]);

        $form->validate($params);

        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->update($params);

        return response()->json(["message" => "ok"], 200);
    }
}