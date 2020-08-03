<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->insert([
            'name' => "Albert Nail 美甲工作室",
            'enabled' => 1,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('companies')->insert([
            'name' => "偶爾做美甲",
            'enabled' => random_int(0, 1),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('companies')->insert([
            'name' => "許聰明家教",
            'enabled' => random_int(0, 1),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
