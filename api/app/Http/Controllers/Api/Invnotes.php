<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\InvNote;

class Invnotes extends \App\Http\Controllers\Controller
{

    public function index(Request $request, string $customer_uuid)
    {
        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        return $customer->notes()->orderBy('created_at', 'desc')->get();
    }

    public function show(Request $request, string $customer_uuid, string $note_id)
    {
        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }
        $note = $customer->notes()->find($note_id);
        return response()->json(['data' => $note], 200);
    }

    public function store(Request $request, string $customer_uuid)
    {
        $params = $request->only(["customer_id", "title", "inventory_id", "note"]);

        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $invnote = InvNote::create([
            'company_id' => auth()->user()->company_id,
            'customer_id' => $customer->id,
            'note' => $params['note'],
            'inventory_id' => $params['inventory_id'] ?? 0,
        ]);
        $customer->inventory->find($params['inventory_id'])->update(['note_id' => $invnote->id]);

        $this->logging($request, $params["inventory_id"]);

        return response()->json(["message" => "ok"], 200);
    }

    public function update(Request $request, string $customer_uuid, string $note_id)
    {
        $params = $request->only(["customer_id", "inventory_id", "note"]);

        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->notes()->find($note_id)->update($params);

        $this->logging($request, $note_id);

        return response()->json(["message" => "ok"], 200);
    }

    public function destroy(Request $request, string $customer_uuid, string $note_id)
    {
        $inventory_id = $request->get("inventory_id");

        if (!$customer = my_customer_by_uuid($customer_uuid)) {
            return response()->json(["message" => "查無此使用者"], 422);
        }

        $customer->notes()->find($note_id)->delete();
        $customer->inventory->find($inventory_id)->update(['note_id' => 0]);

        $this->logging($request);

        return response()->json(["message" => "ok"], 200);
    }
}
