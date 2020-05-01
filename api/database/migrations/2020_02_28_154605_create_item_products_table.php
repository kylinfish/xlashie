<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('menu_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->integer('amount');
            $table->smallInteger('order')->unsigned()->default(0);

            $table->timestamps();

            $table->index(['menu_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
}
