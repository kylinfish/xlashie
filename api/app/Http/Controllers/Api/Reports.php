<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\OrderItem;


class Reports extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $from = date('2019-11-01');
        $to = date('Y/m/d H:i:s');

        $group_by_date = my_comp()->ticket()
            ->whereBetween('created_at', [$from, $to])->groupBy('date')
            ->orderBy('date', 'asc')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));

        $t_ids = [];
        $total_expense = 0;
        $payments = [];
        $customer_unique_list = [];

        $tickets = my_comp()->ticket()->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();
        foreach ($tickets as $ticket) {
            $t_ids[] = $ticket->id;
            $total_expense += $ticket->price;
            if (array_key_exists($ticket->payment, $payments)) {
                $payments[$ticket->payment] += 1;
            } else {
                $payments[$ticket->payment] = 1;
            }
            $customer_unique_list[$ticket->customer_id] = 1;
        }

        $product_list = [];
        $product_quantity = [];
        $product_price = [];

        $order_items = OrderItem::whereIn('order_id', $t_ids)->get();
        foreach ($order_items as $item) {
            if (array_key_exists($item->product_name, $product_list)) {
                $product_list[$item->product_name] += 1;
            } else {
                $product_list[$item->product_name] = 1;
            }

            if (array_key_exists($item->product_name, $product_quantity)) {
                $product_quantity[$item->product_name] += $item->quantity;
            } else {
                $product_quantity[$item->product_name] = $item->quantity;
            }

            if (array_key_exists($item->price, $product_price)) {
                $product_price[$item->product_name] += $item->unit_price;
            } else {
                $product_price[$item->product_name] = $item->unit_price;
            }
        }
        arsort($product_quantity);
        arsort($product_list);

        return response()->json([
            'data' => [
                'orders' => [
                    'total_count' => $order_items->count(),
                    'uniq_customer_count' => count($customer_unique_list),
                    'payments' => $payments,

                    'total_expense' => $total_expense,
                ],
                'group_by_date' => $group_by_date,
                'items' => [
                    'product_list' => $product_list,
                    'product_quantity' => $product_quantity,
                    'product_price' => $product_price,
                ]
            ]
        ]);
    }
}
