
<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('orders')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'ticket' => 'INV-001',
            'payment' => '現金',
            'discount' => 40,
            'price' => 4000,
            'note' => '買好買滿',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('orders')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'ticket' => 'INV-002',
            'payment' => '轉帳',
            'discount' => 0,
            'price' => 2850,
            'note' => 'Richart',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('order_items')->insert([
            'order_id' => 1,
            'product_name' => '玫瑰晚霜',
            'quantity' => 2,
            'unit_price' => 2020,
        ]);
        for ($i = 0; $i <=2 ; $i++) {
            DB::table('order_items')->insert([
                'order_id' => 2,
                'product_name' => '護膚課程 - 美白系列',
                'quantity' => 1,
                'unit_price' => 950,
            ]);

            DB::table('customer_inventories')->insert([
                'company_id' => 1,
                'customer_id' => 1,
                'product_name' => '護膚課程 - 美白系列',
                'status' => 1,
            ]);
        }
    }
}
