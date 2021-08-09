<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Forms\CustomerForm;
use App\Http\Resources\CustomerResource;

class Customers extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $limit = request('limit', 5);
        $customers = my_customer()->orderBy('id', 'desc')->get();
        return CustomerResource::collection($this->paginate($customers, $limit));
    }

    public function show(Request $request, string $customer_uuid)
    {
        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return new CustomerResource($customer);
    }

    public function update(Request $request, CustomerForm $form, string $customer_uuid)
    {
        $params = $request->only(["name", "email", "phone", "cellphone", "gender", "address", "charged_by", "birth", "note_1", "note_2"]);

        $form->validate($params);

        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->update($params);

        $this->logging($request, $customer->id);

        return response()->json(["message" => "ok"], 200);
    }
}
