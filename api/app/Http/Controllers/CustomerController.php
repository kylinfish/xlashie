<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Repositories\TicketRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerInventoryRepository;
use App\Models\Menu;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Transformers\Customer as Transformer;

class CustomerController extends \App\Http\Controllers\Controller
{
    public function __construct(
        TicketRepository $order_repo,
        CustomerRepository $customer_repo,
        CustomerInventoryRepository $ci_repo,
        CustomerForm $form,
        CustomerService $service
    ) {
        $this->form = $form;
        $this->service = $service;
        $this->repo = $customer_repo;
        $this->ci_repo = $ci_repo;
        $this->order_repo = $order_repo;
    }

    public function index(Request $request)
    {
        $this->form->validate($request->all());

        $limit = request('limit', 10);
        $customers = Customer::where("user_id", auth()->user()->id)->orderBy("id", "ASC")->get();
        $customers = $this->paginate($customers, $limit);

        return view("customers.index", compact("customers"));
    }

    public function show(Request $request, string $customer_uuid)
    {

        $this->form->validate(['uuid' => $customer_uuid]);

        $customer = Customer::where(["user_id" => auth()->user()->id, "uuid" => $customer_uuid])->first();

        if ($customer == null) {
            ### FIXME
            return redirect()->route("customers.index");
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
        $user_id = user()->id;
        $keyword = $request['q'];
        $customers = Customer::where('user_id', user()->id)
            ->where(function($q) use ($keyword ){
                $q->where('email', 'like', "%{$keyword}%")
                ->orWhere('phone', 'like', "%{$keyword}%")
                ->orWhere('cellphone', 'like', "%{$keyword}%");

            })->get();

        $customers = $this->paginate($customers, $limit);

        return view("customers.index", compact("customers"));
    }
}
