<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priceitems', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned(); // user_id 是不是每份都要 bind?
            $table->integer('shop_id')->unsigned();

            $table->string('name', 40);
            $table->integer('price');
            $table->tinyInteger('item_type')->default(0)->unsigned(); // 0. 單品項目 1. 組合項目
            $table->integer('bonus')->default(0)->unsigned();

            $table->timestamps();

            $table->index(['user_id', 'shop_id']);
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
        Schema::dropIfExists('priceitems');
    }
}
