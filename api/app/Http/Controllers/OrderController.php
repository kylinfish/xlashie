<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Forms\OrderForm;
use App\Services\OrderService;
use App\Repositories\OrderRepository;
use App\Models\Company;

class OrderController extends Controller
{
    public function __construct(OrderRepository $order_repo, OrderForm $form, OrderService $service)
    {
        // hardcode should be instead of real query
        $this->company_id = Company::find(1)->first()->id;
        $this->form = $form;
        $this->repo = $order_repo;
        $this->service = $service;
        $this->service->setCompanyId($this->company_id);
    }

    public function store(Request $request)
    {
        $params = $request->only(["customer_id", "ticket", "pay_type", "purchase_price", "discount", "note", "order_items"]);
        #TODO: order_items should be verified by the form.
        $this->form->validate($params);

        $this->service->createOrder($params);
        exit(1);
    }
}
