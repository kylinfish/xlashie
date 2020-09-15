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
        $orders = Ticket::where(["company_id" => auth()->user()->company_id, "customer_id"=> $customer->id])->ordered();
        $menus = Menu::where("company_id", auth()->user()->company_id)->get();

        return view("customers.show", compact('customer', 'inventories', 'orders', 'menus'));
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "phone", "email", "fb", "line", "birth", "note"]);

        $this->form->validate($params);

        $params["user_id"] = auth()->user()->id;

        $customer = $this->service->createCustomer($params);

        return $this->response->item($customer, new Transformer)->setMeta([
            "message" => "{$customer->name} 新增成功",
        ]);
    }
}
