<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('shop_id')->unsigned();

            $table->string('name', 20);
            $table->tinyInteger('type')->unsigned(); // 1. 直接折扣金額 2. 算 % 數
            $table->integer('dis_value');
            $table->date("start_at");
            $table->date("end_at");

            $table->timestamps();

            $table->index(['user_id', 'shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
