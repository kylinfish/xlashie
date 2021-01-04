<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->menus();
    }

    private function menus()
    {
        DB::table('menus')->insert([
            'company_id' => 1,
            'name' => "手部護理組合",
            'price' => 2300,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'name' => "足部護理組合",
            'price' => 3000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'name' => "日本凝膠指甲 - 透明凝膠",
            'price' => "1200",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'price' => "1200",
            'name' => "日本凝膠指甲 - 單色凝膠",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'price' => "1500",
            'name' => "日本凝膠指甲 - 璀璨凝膠",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'price' => 5000,
            'name' => "日本凝膠指甲 - 透明凝膠 x 5",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
