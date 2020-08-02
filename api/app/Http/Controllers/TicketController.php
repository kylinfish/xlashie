<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Forms\TicketForm;
use App\Services\TicketService;
use App\Repositories\TicketRepository;
use App\Models\Company;

class TicketController extends Controller
{
    public function __construct(TicketRepository $order_repo, TicketForm $form, TicketService $service)
    {
        $this->company_id = user()->company->first()->id;
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

        return response()->json(["message" => "okay"]);
    }
}
