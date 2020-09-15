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
    public function index(Request $request, string $customer_uuid)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return CustomerInventoryResource::collection(
            $customer->inventory()->orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * 用來修改庫存單品得狀態，目前沒有需求提供單品資料修改
     */
    public function update(Request $request, InventoryForm $form, string $customer_uuid)
    {
        $params = $request->only(["id", "note", "status", "use_at"]);

        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }
        $customer->inventory()->find($params["id"])->update($params);

        return response()->json(["message" => "ok"], 200);
    }
}