<?php
namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Repositories\OrderRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerInventoryRepository;
use App\Models\User;
use App\Models\Company;
use App\Models\Customer;
use App\Transformers\Customer as Transformer;

class CustomerController extends \App\Http\Controllers\Controller
{
    use Helpers;

    public function __construct(
        OrderRepository $order_repo, 
        CustomerRepository $customer_repo, 
        CustomerInventoryRepository $ci_repo, 
        CustomerForm $form,
        CustomerService $service
    ) {
        // hardcode should be instead of real query
        $this->user_id = User::find(1)->first()->id;
        $this->company_id = Company::find(1)->first()->id;

        $this->form = $form;
        $this->service = $service;
        $this->repo = $customer_repo;
        $this->ci_repo = $ci_repo;
        $this->order_repo = $order_repo;

        
    }

    public function index(Request $request)
    {
        $this->form->validate($request->all());

        $params["user_id"] = $this->user_id;


        $limit = request('limit', 5);
        $customers = Customer::where("user_id", $this->user_id)->orderBy("id", "ASC")->get();
        $customers = $this->paginate($customers, $limit);

        return view("customers.index", compact("customers"));
    }

    public function show(Request $request, string $customer_uuid)
    {
        $this->form->validate(['uuid' => $customer_uuid]);

        $customer = $this->repo->getCustomer($this->user_id, $customer_uuid);
        $inventories = $this->ci_repo->getInventories($this->company_id, $customer->id);
        $orders = $this->order_repo->getOrders($this->company_id, $customer->id);

        return view("customers.show", compact('customer', 'inventories', 'orders'));
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
