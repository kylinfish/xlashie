<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('shop_id')->unsigned();

            $table->string('name', 50);
            $table->integer('price')->unsigned();
            $table->integer('bonus')->unsigned()->default(0);
            $table->tinyInteger('item_type')->default(0)->unsigned();

            $table->timestamps();

            $table->index('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
