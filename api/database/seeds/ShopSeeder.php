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
            'en_name' => "albert_nail",
            'owner_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('companies')->insert([
            'name' => "偶爾做美甲",
            'en_name' => 'sometimes_do_nail',
            'owner_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('companies')->insert([
            'name' => "許聰明家教",
            'en_name' => 'hometeach',
            'owner_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
