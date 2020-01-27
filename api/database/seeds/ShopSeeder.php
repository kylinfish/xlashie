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

        DB::table('shops')->insert([
            'name' => "亮麗美容教室",
            'status' => random_int(0, 3),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'name' => "偶爾做美甲",
            'status' => random_int(0, 3),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('shops')->insert([
            'name' => "許聰明家教",
            'status' => random_int(0, 3),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
