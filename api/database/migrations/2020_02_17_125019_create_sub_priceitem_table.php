<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPriceitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_priceitems', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('priceitem_id')->unsigned();
            $table->string('name', 40);
            $table->integer('amount')->default(1)->unsigned();

            $table->timestamps();

            $table->index('priceitem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_priceitems');
    }
}
