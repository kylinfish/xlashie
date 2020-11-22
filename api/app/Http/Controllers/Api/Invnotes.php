<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Customer;
use App\Forms\InventoryForm;
use App\Http\Resources\CustomerInventoryResource;
use App\Models\InvNote;

class InvNotes extends BaseController
{

    public function index(Request $request, string $customer_uuid)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return $customer->notes()->orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, string $customer_uuid, string $note_id)
    {
        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }
        $note = $customer->notes()->find($note_id);
        return response()->json(['data' => $note], 200);
    }

    public function store(Request $request, string $customer_uuid)
    {
        $params = $request->only(["customer_id", "title", "inventory_id", "note"]);

        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $invnote = InvNote::create([
            'company_id' => auth()->user()->company->id,
            'customer_id' => $customer->id,
            'note' => $params['note'],
            'inventory_id' => $params['inventory_id'] ?? 0,
        ]);
        $customer->inventory->find($params['inventory_id'])->update(['note_id' => $invnote->id]);

        return response()->json(["message" => "ok"], 200);
    }

    public function update(Request $request, string $customer_uuid, string $note_id)
    {
        $params = $request->only(["customer_id", "inventory_id", "note"]);

        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->notes()->find($note_id)->update($params);
        return response()->json(["message" => "ok"], 200);
    }

    public function delete(Request $request, string $customer_uuid, string $note_id)
    {
        $params = $request->only(["inventory_id"]);

        if (! $customer = u_customer($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->notes()->find($note_id)->delete();
        $customer->inventory->find($params['inventory_id'])->update(['note_id' => null]);

        return response()->json(["message" => "ok"], 200);
    }
}