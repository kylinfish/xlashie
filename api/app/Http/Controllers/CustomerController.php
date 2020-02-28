<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Repositories\CustomerRepository;
use App\Models\User;

class CustomerController extends \App\Http\Controllers\Controller
{
    public function __construct(CustomerRepository $customer_repo, CustomerForm $form, CustomerService $service)
    {
        // hardcode should be instead of real query
        $this->user_id = User::find(1)->first()->id;

        $this->form = $form;
        $this->service = $service;
        $this->repo = $customer_repo;
    }

    public function index(Request $request)
    {
        $customers = $this->repo->getCustomers($this->user_id);

        return response()->json($customers, 200);
    }

    public function show(Request $request, string $customer_uuid)
    {
        $this->form->validate($request->all());

        $customer = $this->repo->getCustomer($this->user_id, $customer_uuid);

        return response()->json(['data' => $customer], 200);
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $this->form->validate($params);

        $params["user_id"] = $this->user_id;

        $customer = $this->service->createCustomer($params);

        return response()->json([
            'message' => "客戶: {$customer->name} 新增成功",
        ], 200);
    }
}
