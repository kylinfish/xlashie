<?php
namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Repositories\TicketRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerInventoryRepository;
use App\Models\User;
use App\Models\Menu;
use App\Models\Ticket;
use App\Models\Company;
use App\Models\Customer;
use App\Transformers\Customer as Transformer;

class CustomerController extends \App\Http\Controllers\Controller
{
    use Helpers;

    public function __construct(
        TicketRepository $order_repo,
        CustomerRepository $customer_repo,
        CustomerInventoryRepository $ci_repo,
        CustomerForm $form,
        CustomerService $service
    ) {
        $this->user_id = user()->id;
        $this->company_id = user()->company->first()->id;

        $this->form = $form;
        $this->service = $service;
        $this->repo = $customer_repo;
        $this->ci_repo = $ci_repo;
        $this->order_repo = $order_repo;
    }

    public function index(Request $request)
    {
        $this->form->validate($request->all());

        $limit = request('limit', 20);
        $customers = Customer::where("user_id", $this->user_id)->orderBy("id", "ASC")->get();
        $customers = $this->paginate($customers, $limit);

        return view("customers.index", compact("customers"));
    }

    public function show(Request $request, string $customer_uuid)
    {
        $this->form->validate(['uuid' => $customer_uuid]);

        $customer = Customer::where(["user_id" => $this->user_id, "uuid" => $customer_uuid])->first();
        if ($customer == null) {
            ### FIXME
            return redirect()->route("customers.index");
        }

        $inventories = $customer->inventory()->get();
        $orders = Ticket::where(["company_id" => $this->company_id, "customer_id"=> $customer->id])->ordered();
        $menus = Menu::where("company_id", $this->company_id)->get();
        return view("customers.show", compact('customer', 'inventories', 'orders', 'menus'));
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "phone", "email", "fb", "line", "birth", "note"]);

        $this->form->validate($params);

        $params["user_id"] = $this->user_id;

        $customer = $this->service->createCustomer($params);

        return $this->response->item($customer, new Transformer)->setMeta([
            "message" => "{$customer->name} 新增成功",
        ]);
    }
}
