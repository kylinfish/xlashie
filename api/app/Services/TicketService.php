<?php
namespace App\Services;

use Cache;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Ticket;
use App\Models\Product;
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
                "unit_price" => $item["salePrice"],
                "order_id" => $order->id,
            ];
        }
        OrderItem::insert($order_items);


        // 3. Create Customer Inventory

        /*
        // 先看有沒有 sub_menus
        // 如果有:
            需要組出數量，只能從 sub_menus 從新 Query Product 取得 name/type
        // 如果沒有:
            直接新增就可以


        // 以上兩組共同點都需要做(inventories) Insert 的動作，分 TYPE_ENTITY / TYPE_VIRTUAL
        */

        // #TODO: 核銷庫存數量， status 狀態處理

        $inventories = [];
        foreach ($data["items"] as $item) {
            $menu_id = $item["itemId"];
            $menu = Menu::find($menu_id);

            // 知道名稱跟數量 append 進去就好
            if ($menu->has_submenu) {
                foreach ($menu->sub_menus->map->only(["product_id", "amount"]) as $entry) {
                    $product = Product::find($entry["product_id"]);
                    $status = CustomerInventory::STATUS_UNUSED;
                    if (Product::TYPE_ENTITY == $product->status) {
                        $status = CustomerInventory::STATUS_DONE;
                    }
                    if (Product::TYPE_VIRTUAL == $product->status) {
                        $status = CustomerInventory::STATUS_UNUSED;
                    }
                    for ($i = 0; $i < ($entry["amount"] * $item['quantity']); $i++) {
                        $inventories[] = [
                            "customer_id" => $data["customer_id"],
                            "company_id" => $company_id,
                            "product_name" => $product->name,
                            "status" => $status,
                            "created_at" => $data["created_at"],
                            "updated_at" => Carbon::now(),
                        ];
                    }
                }
            } else {
                $status = CustomerInventory::STATUS_UNUSED;
                if (Product::TYPE_ENTITY == $item["product_type"]) {
                    $status = CustomerInventory::STATUS_DONE;
                }
                if (Product::TYPE_VIRTUAL == $item["product_type"]) {
                    $status = CustomerInventory::STATUS_UNUSED;
                }

                for ($i = 0; $i < $item['quantity']; $i++) {
                    $inventories[] = [
                        "customer_id" => $data["customer_id"],
                        "company_id" => $company_id,
                        "product_name" => $item["itemName"],
                        "status" => $status,
                        "created_at" => $data["created_at"],
                        "updated_at" => Carbon::now(),
                    ];
                }
            }
        }
        $this->c_inv_repo->insert($inventories);
    }
}
