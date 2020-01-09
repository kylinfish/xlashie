<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('customers')->insert([
                'shop_id' => random_int(1, 4),
                'uuid' => Str::random(18),
                'gender' => random_int(0, 3),
                'name' => substr($faker->name, 0, 20),
                'email' => $faker->email,
                'birth' => $faker->dateTime,
                'phone' => substr($faker->e164PhoneNumber, 0, 10),
                'note' => $faker->text($maxNbChars = random_int(10, 100)),

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
