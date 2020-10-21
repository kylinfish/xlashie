<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Models\Menu;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Transformers\Customer as Transformer;

class CustomerController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        // 要先有 Company 才能使用 Menu 功能
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->company) {
                return redirect('/company/create/');
            }
            return $next($request);
        });
    }

    public function index(Request $request, CustomerForm $form)
    {
        $limit = request('limit', 10);
        $customers = Customer::where("user_id", auth()->user()->id)->orderBy("id", "ASC")->get();
        $customers = $this->paginate($customers, $limit);

        $is_wizard = ($request->get('wizard') or $customers->count() < 1) ? true : false;

        return view("customers.index", compact("customers", "is_wizard"));
    }

    public function show(Request $request, string $customer_uuid)
    {
        if (!$customer = Customer::where(["user_id" => auth()->user()->id, "uuid" => $customer_uuid])->first()) {
            return redirect()->route("customers.index")
            ->with(['alert' => 'warning', 'message' => "查無此使用者 - {$customer_uuid}"]);
        }

        $inventories = $customer->inventory()->get();
        $orders = Ticket::where(["company_id" => auth()->user()->company->id, "customer_id"=> $customer->id])->ordered();
        $menus = Menu::where("company_id", auth()->user()->company->id)->get();

        return view("customers.show", compact('customer', 'inventories', 'orders', 'menus'));
    }

    public function create(Request $request)
    {
        return view("customers.create");
    }

    public function store(Request $request, CustomerForm $form)
    {
        $params = $request->only(["name", "phone", "cellphone", "email",
        "birth", "note_1", "note_2", "gender", "address"]);
        if ($errors = $form->validate($params)) {
            return redirect()->back()
            ->with(['alert' => 'warning', 'message' => '新增失敗'])
            ->withErrors($errors)
            ->withInput($request->all());
        }
        # XXX: Set default value for Birth/Email fields.
        $customer = Customer::create([
            'uuid' => Str::random(18),
            'user_id' => auth()->user()->id,
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

        return redirect("/customers/{$customer->uuid}")
        ->with(['alert' => 'success', 'message' => '新增成功，開始記錄客戶歷程吧']);
    }

    public function search(Request $request)
    {
        $limit = request('limit', 10);
        $keyword = $request['q'];
        $customers = Customer::where('user_id', auth()->user()->id)
            ->where(function($q) use ($keyword ){
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