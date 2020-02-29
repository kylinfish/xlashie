<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('shop_id')->unsigned();

            $table->string('name', 50);
            $table->string('avatar', 255);
            $table->integer('cost'); //成本
            $table->integer('price');
            $table->tinyInteger('status')->default(0)->unsigned(); // 0: 關閉 1:開放 2:封存
            $table->tinyInteger('category_id')->default(0)->unsigned();
            $table->integer('inventory_count')->default(0)->unsigned();

            $table->timestamps();

            $table->index('shop_id');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
