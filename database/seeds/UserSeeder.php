<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'gender' => random_int(0, 3),
                'name' => substr($faker->name, 0, 20),
                'email' => $faker->email,
                'birth' => $faker->dateTime,
                'phone' => $faker->e164PhoneNumber,
                'password' => $faker->password,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
