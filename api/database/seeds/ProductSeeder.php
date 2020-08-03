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
       $this->products();
       $this->menus();
       $this->submenus();
    }

    private function products()
    {
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "手部 - 指緣基礎修護 30 min",
            'sale_price' => 400,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "手部 - 精緻角質淨化護理 60 min",
            'sale_price' => 700,
            'avatar' => "https://www.decor99.com/thumb420X420canvasgallery/images/dm/DM097.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "手部 - 有機精萃 SPA 深層淨白護理",
            'sale_price' => 1400,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "足部 - 指緣基礎修護 30 min",
            'sale_price' => 600,
            'avatar' => "http://www.botanicus.com.tw/wp-content/uploads/2016/01/45004%E7%8E%AB%E7%91%B0%E6%99%9A%E9%9C%9C-50ml_-10404404.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "足部 - 深層角質淨化護理 60 min",
            'sale_price' => 950,
            'avatar' => "http://www.botanicus.com.tw/wp-content/uploads/2016/01/05790-%E4%BE%9D%E8%98%AD%E6%9F%94%E5%AB%A9%E6%B4%BB%E8%86%9A%E9%9C%9C100g.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "足部 - 有機精萃 SPA 深層淨白護理 120 min",
            'sale_price' => 1800,
            'avatar' => "https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => random_int(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "日本凝膠指甲 - 透明凝膠",
            'sale_price' => 1200,
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
            'name' => "日本凝膠指甲 - 單色凝膠",
            'sale_price' => 1400,
            'avatar' => "https://static.wixstatic.com/media/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg/v1/fill/w_480,h_413,al_c,q_85,usm_0.66_1.00_0.01/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'name' => "日本凝膠指甲 - 璀璨凝膠",
            'sale_price' => 1600,
            'avatar' => "https://static.wixstatic.com/media/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg/v1/fill/w_480,h_413,al_c,q_85,usm_0.66_1.00_0.01/71138d_79c42b67b1be4f7ba5643943009d4c01~mv2.jpg",
            'status' => random_int(0, 3),
            'category_id' => random_int(0, 3),
            'quantity' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function menus()
    {
        DB::table('menus')->insert([
            'company_id' => 1,
            'name' => "手部護理組合 (修護 + 淨化 + 美白)",
            'sale_price' => 2300,
            'purchase_price' => 2500,
            'item_type' => 1,
            'has_submenu' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 0,
            'name' => "足部護理組合 (修護 + 淨化 + 美白)",
            'sale_price' => 3000,
            'purchase_price' => 3350,
            'item_type' => 1,
            'has_submenu' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 7,
            'name' => "日本凝膠指甲 - 透明凝膠",
            'sale_price' => 1200,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 8,
            'name' => "日本凝膠指甲 - 單色凝膠",
            'sale_price' => 1400,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 9,
            'name' => "日本凝膠指甲 - 璀璨凝膠",
            'sale_price' => 1600,
            'item_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('menus')->insert([
            'company_id' => 1,
            'product_id' => 7,
            'name' => "日本凝膠指甲 - 透明凝膠 x 5",
            'sale_price' => 5500,
            'item_type' => 1,
            'has_submenu' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }

    private function submenus()
    {
        DB::table('sub_menus')->insert([
            [
                'menu_id' => 1,
                'product_id' => 1,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'menu_id' => 1,
                'product_id' => 2,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'menu_id' => 1,
                'product_id' => 3,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('sub_menus')->insert([
            [
                'menu_id' => 2,
                'product_id' => 4,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'menu_id' => 2,
                'product_id' => 5,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'menu_id' => 2,
                'product_id' => 6,
                'amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('sub_menus')->insert([
            'menu_id' => 6,
            'product_id' => 7,
            'amount' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
