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
            $table->increments('id');

            $table->char('uuid', 20);
            $table->integer('user_id');
            $table->string('name', 20);
            $table->string('phone', 10);
            $table->string('email', 50);
            $table->tinyInteger('gender');
            $table->date('birth')->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('line', 30)->nullable();
            $table->string('fb', 30)->nullable();
            $table->text('note')->nullable();

            $table->timestamps();

            // index
            $table->unique('uuid')->unique();
            $table->unique(['user_id', 'email']);
            $table->index(['uuid', 'user_id']);
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
