<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Forms\InventoryForm;
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

        #dd($customer->inventory()->orderBy('created_at', 'desc')->get()->toArray);

        return CustomerInventoryResource::collection($customer->inventory()->orderBy('created_at', 'desc')->get());
    }

    /**
     * 用來修改庫存單品得狀態，目前沒有需求提供單品資料修改
     */
    public function update(Request $request, InventoryForm $form, string $customer_uuid)
    {
        $params = $request->only(["id", "note", "status", "use_at"]);

        if (! $customer = Customer::where("uuid", $customer_uuid)->first()) {
            return response()->json(["message" => "查無此使用者"], 422);
        }
        $inv = $customer->inventory()->find($params["id"]);


        $inv->update($params);

        return response()->json(["message" => "ok"], 200);
    }
}