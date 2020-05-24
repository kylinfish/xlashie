<?php
namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Forms\CustomerForm;
use App\Services\CustomerService;
use App\Repositories\CustomerRepository;
use App\Models\User;
use App\Transformers\Customer as Transformer;

class CustomerController extends \App\Http\Controllers\Controller
{
    use Helpers;

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
        $this->form->validate($request->all());

        $params["user_id"] = $this->user_id;

        $customers = $this->repo->getCustomers($this->user_id, $request->all());

        return $this->response->paginator($customers, new Transformer);
    }

    public function show(Request $request, string $customer_uuid)
    {
        $this->form->validate(['uuid' => $customer_uuid]);

        $customer = $this->repo->getCustomer($this->user_id, $customer_uuid);

        return $this->response->item($customer, new Transformer);
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
