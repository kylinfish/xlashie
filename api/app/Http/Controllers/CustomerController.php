<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\CustomerForm;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerController extends \App\Http\Controllers\Controller
{
    public function index(Request $request, CustomerForm $form)
    {
        $limit = request('limit', 10);
        $customers = my_customer()->orderBy("id", "DESC")->get();
        $customers = $this->paginate($customers, $limit);

        return view("customers.index", compact("customers"));
    }

    public function show(Request $request, string $customer_uuid)
    {
        if (!$customer = my_customer()->where(["uuid" => $customer_uuid])->first()) {
            return redirect()->route("customers.index")
                ->with(['alert' => 'warning', 'message' => "查無此使用者 - {$customer_uuid}"]);
        }

        $inventory_count = $customer->inventory()->count();
        $order_count = my_comp()->ticket()->where(["customer_id" => $customer->id])->count();

        return view("customers.show", compact('customer', 'order_count', 'inventory_count'));
    }

    public function create()
    {
        return view("customers.create");
    }

    public function store(Request $request, CustomerForm $form)
    {
        $params = $request->only([
            "name", "phone", "cellphone", "email",
            "birth", "note_1", "note_2", "gender", "address"
        ]);
        if ($errors = $form->validate($params)) {
            return redirect()->back()
                ->with(['alert' => 'warning', 'message' => '新增失敗'])
                ->withErrors($errors)
                ->withInput($request->all());
        }
        # XXX: Set default value for Birth/Email fields.
        $customer = Customer::create([
            'uuid' => Str::random(18),
            'company_id' => user()->company_id,
            'name' => $params["name"] ?? '',
            'phone' => $params["phone"] ?? '',
            'cellphone' => $params["cellphone"] ?? '',
            'birth' => empty($params["birth"]) ? null : $params["birth"],
            'email' => $params["email"] ?? '',
            'note_1' => $params["note_1"] ?? null,
            'note_2' => $params["note_2"] ?? null,
            'gender' => $params["gender"] ?? 0,
            'address' => $params["address"] ?? '',
        ]);

        $this->logging($request, $customer->id);

        return redirect("/customers/{$customer->uuid}")
            ->with(['alert' => 'success', 'message' => '新增成功，開始記錄客戶歷程吧']);
    }

    public function search(Request $request)
    {
        $limit = request('limit', 10);
        $keyword = $request['q'];
        $customers = my_customer()->where(function ($q) use ($keyword) {
            $q->where('email', 'like', "%{$keyword}%")
                ->orWhere('phone', 'like', "%{$keyword}%")
                ->orWhere('name', 'like', "%{$keyword}%")
                ->orWhere('cellphone', 'like', "%{$keyword}%");
        })->get();

        $customers = $this->paginate($customers, $limit);

        return view("customers.index", [
            'customers' => $customers,
            'alert' => 'info', 'message' => "查詢: {$keyword}"
        ]);
    }
}
