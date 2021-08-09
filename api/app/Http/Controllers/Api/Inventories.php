<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\CustomerInventoryResource;

class Inventories extends \App\Http\Controllers\Controller
{
    public function index(Request $request, string $customer_uuid)
    {
        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return CustomerInventoryResource::collection(
            $customer->inventory()->orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * 用來修改庫存單品得狀態，目前沒有需求提供單品資料修改
     */
    public function update(Request $request, string $customer_uuid)
    {
        $params = $request->only(["id", "status", "use_at"]);
        $params["labeled_by"] = user()->id;

        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }
        $customer->inventory()->find($params["id"])->update($params);

        $this->logging($request, $params["id"]);

        return response()->json(["message" => "ok"], 200);
    }
}
