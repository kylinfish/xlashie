
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
        $faker = Faker\Factory::create();

        DB::table('orders')->insert([
            'company_id' => 1,
            'customer_id' => 2,
            'ticket' => 'INV-001',
            'payment' => '現金',
            'discount' => 40,
            'price' => 4000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('orders')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'ticket' => 'INV-002',
            'payment' => '轉帳',
            'discount' => 0,
            'price' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('order_items')->insert([
            'order_id' => 1,
            'product_name' => '玫瑰晚霜',
            'quantity' => 2,
            'unit_price' => 2020,
        ]);

        DB::table('customer_notes')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'title' => $faker->text($maxNbChars = random_int(10, 25)),
            'note' => $faker->text($maxNbChars = random_int(50, 250)),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday(),
        ]);
        DB::table('customer_notes')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'title' => $faker->text($maxNbChars = random_int(10, 25)),
            'note' => $faker->text($maxNbChars = random_int(50, 250)),
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
