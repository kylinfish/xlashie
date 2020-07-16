<?php
namespace App\Services;

use Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\CustomerInventory;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\CustomerInventoryRepository;


class OrderService
{
    public function __construct(
        OrderRepository $order_repo,
        OrderItemRepository $order_item_repo,
        CustomerInventoryRepository $c_inv_repo
    ) {
        $this->order_repo = $order_repo;
        $this->order_item_repo = $order_item_repo;
        $this->c_inv_repo = $c_inv_repo;
    }

    public function setCompanyId(int $id)
    {
        $this->company_id = $id;
    }


    public function createOrder(array $data)
    {
        $data["company_id"] = $this->company_id;

        // 1. Create Order
        $order = $this->order_repo->create($data);

        // 2. Create Order Item for logging
        $order_items = [];
        foreach ($data["order_items"] as $item) {
            unset($item["product_type"]);
            $item["order_id"] = $order->id;
            $order_items[] = $item;
        }
        $this->order_item_repo->insert($order_items);


        // 3. Create Customer Inventory
        foreach ($data["order_items"] as $item) {
            if ($item["product_type"] == Product::TYPE_ENTITY) {
                $this->c_inv_repo->create([
                    "customer_id" => $data["customer_id"],
                    "company_id" => $this->company_id,
                    "product_name" => $item["product_name"],
                    "status" => CustomerInventory::STATUS_DONE,
                ]);
                continue;
            }

            if ($item["product_type"] == Product::TYPE_VIRTUAL) {
                $virtual_items = [];
                for ($i = 0; $i < $item["quantity"]; $i++) {
                    $virtual_items[] = [
                        "customer_id" => $data["customer_id"],
                        "company_id" => $this->company_id,
                        "product_name" => $item["product_name"],
                        "status" => CustomerInventory::STATUS_UNUSED,
                        "created_at" => Carbon::today(),
                        "updated_at" => Carbon::today(),
                    ];
                }
                $this->c_inv_repo->insert($virtual_items);
                continue;
            }
        }
    }
}
