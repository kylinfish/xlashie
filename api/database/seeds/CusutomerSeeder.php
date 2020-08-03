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

        DB::table('customers')->insert([
            'user_id' => 1,
            'uuid' => 'abc123456789012345',
            'gender' => random_int(0, 3),
            'name' => substr($faker->name, 0, 20),
            'email' => $faker->email,
            'birth' => $faker->dateTime,
            'cellphone' => substr($faker->e164PhoneNumber, 0, 10),
            'phone' => substr($faker->e164PhoneNumber, 0, 10),
            'address' => $faker->address,
            'note_1' => $faker->text($maxNbChars = random_int(10, 100)),
            'note_2' => $faker->text($maxNbChars = random_int(10, 100)),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        for ($i = 0; $i < 50; $i++) {
            DB::table('customers')->insert([
                'user_id' => random_int(1, 4),
                'uuid' => Str::random(18),
                'gender' => random_int(0, 3),
                'name' => substr($faker->name, 0, 20),
                'email' => $faker->email,
                'birth' => $faker->dateTime,
                'cellphone' => substr($faker->e164PhoneNumber, 0, 10),
                'phone' => substr($faker->e164PhoneNumber, 0, 10),
                'address' => $faker->address,
                'note_1' => $faker->text($maxNbChars = random_int(10, 100)),
                'note_2' => $faker->text($maxNbChars = random_int(10, 100)),

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
