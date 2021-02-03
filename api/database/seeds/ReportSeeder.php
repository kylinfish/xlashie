<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    const PRODUCT_MAP =  [
        1 => [
            'name' => "手部護理組合",
            'price' => 2300,
        ],
        2 => [
            'name' => "足部護理組合",
            'price' => 3000,
        ],
        3 => [
            'name' => "日本凝膠指甲 - 透明凝膠",
            'price' => 1200,
        ],
        4 => [
            'price' => 1200,
            'name' => "日本凝膠指甲 - 單色凝膠",
        ],
        5 => [
            'price' => 1500,
            'name' => "日本凝膠指甲 - 璀璨凝膠",
        ],
        6 => [
            'price' => 5000,
            'name' => "日本凝膠指甲 - 透明凝膠 x 5",
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = ['現金', '刷卡', 'ATM轉帳', '電子支付'];

        $faker = Faker\Factory::create();


        for ($order_id = 1; $order_id <= 100; $order_id++) {
            $created_date = $faker->dateTimeInInterval($startDate = '-35 days', $interval = '+ 5 days', $timezone = 'Asia/Taipei');
            $customer_id = rand(1, 30);

            list($items, $total_count) = $this->apenndAndGetBuyItems($order_id, $customer_id, $created_date);
            DB::table('order_items')->insert($items);

            DB::table('orders')->insert([
                'ticket' => '',
                'company_id' => 1,
                'customer_id' => $customer_id,
                'payment' => $payments[rand(0, 3)],
                'price' => $total_count,
                'created_at' => $created_date,
                'updated_at' => $created_date,
            ]);
        }
    }

    public function apenndAndGetBuyItems($order_id, $customer_id, $created_date)
    {
        $total_count = 0;
        $dict = [];
        for ($i = 0; $i <= rand(1, 10); $i++) {
            $product = ReportSeeder::PRODUCT_MAP[rand(1, 6)];
            $q = rand(1, 5);
            $dict[] = [
                "order_id" => $order_id,
                "product_name" => $product["name"],
                "quantity" =>  $q,
                "unit_price" =>  $product["price"],
            ];

            $total_count += $q * $product["price"];

            DB::table('customer_inventories')->insert([
                "company_id" => 1,
                "customer_id" => $customer_id,
                "product_name" => $product["name"],
                "order_id" => 2,
                "created_at" => $created_date,
                "updated_at" => $created_date,
                "note_id" => 0,
            ]);
        }

        return [$dict, $total_count];
    }
}
