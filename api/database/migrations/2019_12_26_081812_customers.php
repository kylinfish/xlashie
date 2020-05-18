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
            $table->integer('user_id')->unsigned();
            $table->string('name', 20);
            $table->string('phone', 10)->default('');
            $table->string('cellphone', 10)->default('');
            $table->string('email', 50);
            $table->string('tax_number')->nullable(); // 統一編號
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->date('birth')->nullable();
            $table->string('avatar', 256)->default('');
            $table->string('line', 50)->default('');
            $table->string('fb', 50)->default('');
            $table->text('address')->nullable();
            $table->text('note_1')->nullable();
            $table->text('note_2')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->unique(['user_id', 'uuid']);
            $table->unique('email');
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
