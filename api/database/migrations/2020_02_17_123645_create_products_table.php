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
            $table->integer('company_id')->unsigned();

            $table->string('name', 50);
            $table->string('sku', 30);
            $table->string('avatar', 255)->default('');
            $table->double('sale_price', 15, 4)->default(0);
            $table->double('purchase_price', 15, 4)->default(0);
            $table->tinyInteger('status')->default(0)->unsigned(); // 0: 關閉 1:開放 2:封存
            $table->tinyInteger('category_id')->default(0)->unsigned();
            $table->integer('quantity')->default(0)->unsigned();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('company_id');
            $table->unique(['company_id', 'sku']);
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
