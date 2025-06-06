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
        $customers = my_customer()->with('charged_by_user')->orderBy("id", "DESC")->get();
        $customers = $this->paginate($customers, $limit);

        $is_group = my_comp()->is_group;
        return view("customers.index", compact("customers", "is_group"));
    }

    public function show(Request $request, string $customer_uuid)
    {
        if (!$customer = my_customer()->where(["uuid" => $customer_uuid])->first()) {
            return redirect()->route("customers.index")
                ->with(['alert' => 'warning', 'message' => "查無此使用者 - {$customer_uuid}"]);
        }

        $inventory_count = $customer->inventory()->count();
        $order_count = my_comp()->ticket()->where(["customer_id" => $customer->id])->count();

        $menus = my_comp()->menu()->get(['id', 'name', 'price', 'init_status'])->toJson();
        $is_group = my_comp()->is_group;
        $user_list = my_comp()->user()->get(['id', 'name'])->toJson();

        $return_view = view("customers.show", compact('customer', 'order_count', 'inventory_count', 'menus', 'is_group', 'user_list'));
        if (my_comp()->menu()->count() == 0) {
            return $return_view->with(['alert' => 'warning', 'message' => '尚無營業項目可以新增訂單，請由 [首頁] -> [營業項目] 進行新增']);
        }
        return $return_view;
    }

    public function create()
    {
        $user_list = my_comp()->user()->get(['id', 'name']);
        $is_group = my_comp()->is_group;

        return view("customers.create", compact('is_group', 'user_list'));
    }

    public function store(Request $request, CustomerForm $form)
    {
        $params = $request->only([
            "name", "phone", "cellphone", "email", "charged_by",
            "birth", "note_1", "note_2", "gender", "address"
        ]);
        if ($errors = $form->validate($params)) {
            return redirect()->back()
                ->with(['alert' => 'warning', 'message' => '新增失敗'])
                ->withErrors($errors)
                ->withInput($request->all());
        }
        # XXX: Set default value for Birth/Email fields.
        $customer = my_customer()->create([
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
            'charged_by' => $params["charged_by"] ?? 0,
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

        $is_group = my_comp()->is_group;
        return view("customers.index", [
            'is_group' => $is_group,
            'customers' => $customers,
            'alert' => 'info', 'message' => "查詢: {$keyword}"
        ]);
    }

    public function import(Request $request)
    {
        return view("customers.import");
    }

    public function upload(Request $request, CustomerForm $form)
    {
        if ($errors = $form->validate($request->only(['file', 'skip_head_line']))) {
            return redirect()->back()
                ->with(['alert' => 'warning', 'message' => '上傳失敗'])
                ->withErrors($errors)
                ->withInput($request->all());
        }

        $file = fopen($request->file('file')->getPathname(), 'r');
        $line = 0;

        if ($request->has('skip_head_line')) {
            fgetcsv($file);
            $line += 1;
        }

        $form->setRules($form->getStoreRules());

        $customers = [];
        $error_lines = [];
        while ($row = fgetcsv($file)) {
            $line += 1;
            $params = [
                'email' => $row[0] ?? '',
                'name' => $row[1] ?? '',
                'phone' => $row[2] ?? '',
                'cellphone'  => $row[3] ?? '',
                'birth' => date('Y-m-d', strtotime($row[4])) ?? null,
                'gender' => (int) $row[5] ?? 0,
                'address' => $row[6] ?? '',
                'note_1' => $row[7] ?? null,
                'note_2' => $row[8] ?? null,
            ];

            if ($errors = $form->validate($params)) {
                $error_lines[$line] = $errors;
                continue;
            }

            $customers[] = array_merge([
                'uuid' => Str::random(18),
                'company_id' => user()->company_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], $params);
        }

        $before_insert_count = my_customer()->count();

        Customer::insert($customers);

        $after_insert_count = my_customer()->count();

        $this->logging($request, $after_insert_count - $before_insert_count);

        if (0 < count($error_lines)) {
            return redirect(route('customers/import'))
                ->with(['alert' => 'warning', 'message' => '上傳成功！但部分新增失敗！'])
                ->withErrors([
                    'error_lines' => $error_lines,
                ]);
        }

        return redirect('/customers')
            ->with(['alert' => 'success', 'message' => '上傳成功！']);
    }
}
