<?php
namespace App\Services;

use Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerInventory;
use App\Repositories\TicketRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\CustomerInventoryRepository;


class TicketService
{
    public function __construct(
        TicketRepository $ticket_repo,
        OrderItemRepository $order_item_repo,
        CustomerInventoryRepository $c_inv_repo
    ) {
        $this->ticket_repo = $ticket_repo;
        $this->order_item_repo = $order_item_repo;
        $this->c_inv_repo = $c_inv_repo;
    }

    public function setCompanyId(int $id)
    {
        $this->company_id = $id;
    }


    public function createOrder(array $data)
    {
        $data["customer_id"] = Customer::where('uuid', $data['customer_uuid'])->first()->id;
        $data["company_id"] = $this->company_id;

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

        $this->order_item_repo->insert($order_items);


        // 3. Create Customer Inventory

        /*
        // 先看有沒有 sub_menus
        // 如果有:
            需要組出數量，只能從 sub_menus 從新 Query Product 取得 name/type
        // 如果沒有:
            直接新增就可以


        // 以上兩組共同點都需要做(inventories) Insert 的動作，分 TYPE_ENTITY / TYPE_VIRTUAL
        */

        $inventories = [];
        foreach ($data["items"] as $item) {
            $menu_id = $item["itemId"];

            if ($sub_menus = Menu::find($menu_id)->sub_menu->all()) {
                foreach ($sub_menus as $s_menu) {


                }

            }


            if ($item["product_type"] == Product::TYPE_ENTITY) {
                $inventories = [
                    "customer_id" => $data["customer_id"],
                    "company_id" => $this->company_id,
                    "product_name" => $item["itemName"],
                    "status" => CustomerInventory::STATUS_DONE,
                    "created_at" => Carbon::today(),
                    "updated_at" => Carbon::today(),
                ];
            } elseif ($item["product_type"] == Product::TYPE_VIRTUAL) {
                for ($i = 0; $i < $item["quantity"]; $i++) {
                    $inventories[] = [
                        "customer_id" => $data["customer_id"],
                        "company_id" => $this->company_id,
                        "product_name" => $item["itemName"],
                        "status" => CustomerInventory::STATUS_UNUSED,
                        "created_at" => Carbon::today(),
                        "updated_at" => Carbon::today(),
                    ];
                }
            }
            $this->c_inv_repo->insert($inventories);

        }
    }

    private function createSubProduct(SubMenu $sub_menus, string $customer_id)
    {
        foreach ($sub_menus as $s_menu) {
            $inventories = [];
            for ($i = 0; $i <= $s_menu->amount; $i++) {
                $inventories[] = [
                    "customer_id" => $customer_id,
                    "company_id" => $this->company_id,
                    "product_name" => Product::find($s_menu["product_id"])->name,
                    "status" => CustomerInventory::STATUS_DONE,
                ];
            }
            CustomerInventory::insert($inventories);
        }

    }

    private function generateInventoriesArray()
    {

    }
}
