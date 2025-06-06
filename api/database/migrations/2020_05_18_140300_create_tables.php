<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('users', function ($table) {
            $table->increments('id')->unsigned();

            $table->integer('company_id')->unsigned()->default(0);
            $table->string('uuid', 40);
            $table->string('name', 20);
            $table->char('password', 60);
            $table->string('phone', 10);
            $table->string('email', 50);
            $table->string('avatar', 256)->default('');
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->date('birth')->nullable();
            $table->string('identify_provider', 15)->default('');
            $table->string('identify_id', 30)->default('');

            $table->rememberToken();

            $table->timestamps();

            // index
            $table->unique('uuid');
            $table->unique('email');
            $table->index('phone');
        });

        Schema::create('companies', function ($table) {
            $table->increments('id')->unsigned();

            $table->integer('owner_id')->unsigned();
            $table->string('name', 30);
            $table->string('account', 30)->default('');
            $table->string('contact', 50)->default('');
            $table->string('description', 100)->default('');
            $table->timestamps();
        });

        Schema::create('customers', function ($table) {
            $table->increments('id')->unsigned();

            $table->integer('company_id')->unsigned();
            $table->char('uuid', 18);
            $table->string('email', 50)->default('');
            $table->string('name', 20)->default('');
            $table->string('phone', 10)->default('');
            $table->string('cellphone', 10)->default('');
            $table->date('birth')->nullable();
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->string('avatar', 256)->default('');
            $table->string('address', 150)->default('');
            $table->string('identify_provider', 15)->default('');
            $table->string('identify_id', 30)->default('');
            $table->text('note_1')->nullable();
            $table->text('note_2')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->unique(['company_id', 'uuid']);
            $table->index('email');
            $table->index('phone');
        });

        Schema::create('customer_notes', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('customer_id')->unsigned();

            $table->integer('inventory_id')->default(0);
            $table->string('title', 25)->default('');
            $table->longText('note')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->index(['company_id', 'customer_id', 'inventory_id']);
        });

        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->string('name', 20);
            $table->tinyInteger('type')->unsigned(); // 1. 直接折扣金額 2. 算 % 數
            $table->integer('dis_value');
            $table->date("start_at");
            $table->date("end_at");

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'company_id']);
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('name', 50);
            $table->integer('price')->default(0);
            $table->tinyInteger('init_status')->default(-1);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id']);
        });


        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('ticket', 10);
            $table->string('payment', 10);
            $table->integer('discount')->default(0);
            $table->integer('price')->default(0);
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'customer_id']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->string('product_name', 50);
            $table->integer('quantity')->unsigned();
            $table->integer('unit_price')->default(0);

            $table->index(['order_id']);
        });

        Schema::create('customer_inventories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('order_id')->unsigned();

            $table->string('product_name', 50);
            $table->tinyInteger('status')->default(-1);
            $table->integer('note_id')->unsigned();
            $table->timestamp('use_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'customer_id']);
        });

        Schema::create('op_logs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('controller')->unsigned();
            $table->tinyInteger('action')->unsigned();
            $table->string('sth')->default('');
            $table->timestamps();

            $table->index(['company_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('failed_jobs');

        // Role
        Schema::dropIfExists('users');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('companies');

        // Products
        Schema::dropIfExists('products');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('menus');

        // Orders
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('customer_inventories');
        Schema::dropIfExists('customer_notes');
        Schema::dropIfExists('op_logs');
    }
}
