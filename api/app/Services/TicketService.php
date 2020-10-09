<?php
namespace App\Services;

use Cache;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Ticket;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\CustomerInventory;
use App\Repositories\TicketRepository;
use App\Repositories\CustomerInventoryRepository;


class TicketService
{
    public function __construct(
        TicketRepository $ticket_repo,
        CustomerInventoryRepository $c_inv_repo
    ) {
        $this->ticket_repo = $ticket_repo;
        $this->c_inv_repo = $c_inv_repo;
    }

    public function createOrder($company_id, array $data)
    {
        $data["customer_id"] = Customer::where('uuid', $data['customer_uuid'])->first()->id;
        $data["company_id"] = $company_id;
        $data["created_at"] = Carbon::parse($data["transaction_at"]);

        // 1. Create Order
        $order = Ticket::create($data);

        // 2. Create Order Item for logging
        $order_items = [];
        foreach ($data["items"] as $item) {
            $order_items[] = [
                "product_name" => $item["itemName"],
                "quantity" => $item["quantity"],
                "unit_price" => $item["price"],
                "order_id" => $order->id,
            ];
        }
        OrderItem::insert($order_items);

        // 3. Create Customer Inventory
        $inventories = [];
        foreach ($data["items"] as $item) {
            for ($i = 0; $i < $item['quantity']; $i++) {
                $inventories[] = [
                    "customer_id" => $data["customer_id"],
                    "company_id" => $company_id,
                    "product_name" => $item["itemName"],
                    "status" => $item["initStatus"],
                    "created_at" => $data["created_at"],
                    "updated_at" => Carbon::now(),
                ];
            }
        }
        $this->c_inv_repo->insert($inventories);
    }
}
