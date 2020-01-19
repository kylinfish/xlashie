<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function($table)
        {
            $table->increments('id')->unsigned();

            $table->char('uuid', 18);
            $table->integer('shop_id')->unsigned();
            $table->string('name', 20);
            $table->string('phone', 10)->default('');
            $table->string('email', 50);
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->date('birth')->nullable();
            $table->string('avatar', 100)->default('');
            $table->string('line', 30)->default('');
            $table->string('fb', 30)->default('');
            $table->text('note')->nullable();

            $table->timestamps();

            // index
            $table->unique('uuid')->unique();
            $table->unique(['shop_id', 'uuid']);
            $table->index('email');
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
