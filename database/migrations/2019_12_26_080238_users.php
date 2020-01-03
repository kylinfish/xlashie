<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->increments('id');

            $table->char('uuid', 20);
            $table->string('name', 20);
            $table->char('password', 60);
            $table->string('phone', 15);
            $table->string('email', 50);
            $table->tinyInteger('gender');
            $table->date('birth')->nullable();
            $table->string('avatar', 100)->nullable();
            $table->string('line', 30)->nullable();
            $table->string('fb', 30)->nullable();

            $table->timestamps();

            // index
            $table->unique('uuid');
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
        Schema::dropIfExists('users');
    }
}
