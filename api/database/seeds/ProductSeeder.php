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
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "護膚乳霜",
            'sale_price' => 300,
            'sale_price' => 650,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "護膚海藻面膜",
            'purchase_price' => 150,
            'sale_price' => 200,
            'avatar' => "https://www.decor99.com/thumb420X420canvasgallery/images/dm/DM097.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "薰衣草潤膚皂【液體狀】500ml",
            'purchase_price' => 950,
            'sale_price' => 1930,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "玫瑰晚霜",
            'purchase_price' => 1589,
            'sale_price' => 2020,
            'avatar' => "http://www.botanicus.com.tw/wp-content/uploads/2016/01/45004%E7%8E%AB%E7%91%B0%E6%99%9A%E9%9C%9C-50ml_-10404404.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "依蘭柔嫩活膚霜",
            'sale_price' => 789,
            'purchase_price' => 2020,
            'avatar' => "http://www.botanicus.com.tw/wp-content/uploads/2016/01/05790-%E4%BE%9D%E8%98%AD%E6%9F%94%E5%AB%A9%E6%B4%BB%E8%86%9A%E9%9C%9C100g.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "薰衣草潤膚皂【液體狀】500ml",
            'sale_price' => 950,
            'purchase_price' => 1930,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "液體狀Dermaroller玻尿酸原液膠原蛋白蠶絲面膜 10片 ",
            'sale_price' => 2200,
            'purchase_price' => 3000,
            'avatar' => "https://static.wixstatic.com/media/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg/v1/fill/w_480,h_413,al_c,q_85,usm_0.66_1.00_0.01/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "護膚潔美課程",
            'sale_price' => 600,
            'purchase_price' => 0,
            'avatar' => "https://static.wixstatic.com/media/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg/v1/fill/w_480,h_413,al_c,q_85,usm_0.66_1.00_0.01/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Menus

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 3,
            'name' => "薰衣草潤膚皂【液體狀】500ml",
            'sale_price' => 1930,
            'purchase_price' => 950,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 7,
            'name' => "液體狀Dermaroller玻尿酸原液膠原蛋白蠶絲面膜 10片 ",
            'sale_price' => 2200,
            'purchase_price' => 3000,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 0,
            'name' => "限時優惠大課程 ",
            'sale_price' => 3000,
            'purchase_price' => 3000,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('sub_menus')->insert([
            'menu_id' => 3,
            'product_id' => 7,
            'amount' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
