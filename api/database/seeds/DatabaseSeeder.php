<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ReportSeeder');
        $this->call('UserSeeder');
        $this->call('CustomerSeeder');
        $this->call('ShopSeeder');
        $this->call('ProductSeeder');
        $this->call('OrderInventorySeeder');
    }
}
