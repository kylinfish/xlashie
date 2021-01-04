
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
