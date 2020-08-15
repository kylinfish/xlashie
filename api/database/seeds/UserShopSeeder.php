<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('user_company')->insert([
            'user_id' => 1,
            'company_id' => 1,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_company')->insert([
            'user_id' => 2,
            'company_id' => 2,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_company')->insert([
            'user_id' => 3,
            'company_id' => 3,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
