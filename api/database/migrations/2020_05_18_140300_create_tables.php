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

        Schema::create('users', function($table) {
            $table->increments('id')->unsigned();

            $table->integer('company_id')->unsigned();
            $table->string('uuid', 40);
            $table->string('name', 20);
            $table->char('password', 60);
            $table->string('phone', 15);
            $table->string('email', 50);
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->date('birth')->nullable();
            $table->string('avatar', 256)->default('');
            $table->string('line', 30)->default('');
            $table->string('fb', 30)->default('');
            $table->rememberToken();

            $table->timestamps();

            // index
            $table->unique('uuid');
            $table->unique('email');
            $table->index('phone');
        });

        Schema::create('customers', function($table) {
            $table->increments('id')->unsigned();

            $table->integer('user_id')->unsigned();
            $table->char('uuid', 18);
            $table->string('name', 20);
            $table->string('phone', 10)->default('');
            $table->string('cellphone', 10)->default('');
            $table->string('email', 50);
            $table->string('tax_number')->default(''); // 統一編號
            $table->date('birth')->nullable();
            $table->tinyInteger('gender')->default(0)->unsigned();
            $table->tinyInteger('discount_id')->default(0)->unsigned();
            $table->string('avatar', 256)->default('');
            $table->string('line', 50)->default('');
            $table->string('fb', 50)->default('');
            $table->string('address', 150)->default('');
            $table->text('note_1')->nullable();
            $table->text('note_2')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->unique(['user_id', 'uuid']);
            $table->unique('email');
            $table->index('phone');
        });

        Schema::create('customer_notes', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('customer_id')->unsigned();

            $table->integer('inventory_id')->default(0);
            $table->string('title', 25)->default('');
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // index
            $table->index(['company_id', 'customer_id', 'inventory_id']);
        });

        Schema::create('companies', function($table) {
            $table->increments('id')->unsigned();

            $table->string('name', 50);
            $table->boolean('enabled')->default(1);

            $table->timestamps();
            $table->softDeletes();
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

            $table->index(['user_id', 'company_id']);
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->string('name', 50);
            $table->string('sku', 30)->default('');
            $table->string('avatar', 255)->default('');
            $table->integer('sale_price')->default(0);
            $table->integer('purchase_price')->default(0);
            $table->tinyInteger('status')->default(0)->unsigned(); // 0: 關閉 1:開放 2:封存
            $table->tinyInteger('category_id')->default(0)->unsigned();
            $table->integer('quantity')->default(0)->unsigned();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'name']);
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('product_id')->unsigned()->default(0);

            $table->string('name', 50);
            $table->integer('sale_price')->default(0);
            $table->integer('purchase_price')->default(0);
            $table->integer('bonus')->unsigned()->default(0);
            $table->tinyInteger('item_type')->default(0)->unsigned();
            $table->boolean('has_submenu')->default(false);

            $table->timestamps();

            $table->index(['company_id', 'product_id']);
        });

        Schema::create('sub_menus', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('menu_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->integer('amount');
            $table->smallInteger('order')->unsigned()->default(0);

            $table->timestamps();

            $table->index(['menu_id', 'product_id']);
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

            $table->string('product_name', 50);
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->timestamp('use_at')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'customer_id']);
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
        Schema::dropIfExists('sub_menus');

        // Orders
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('customer_inventories');
        Schema::dropIfExists('customer_notes');

    }
}
