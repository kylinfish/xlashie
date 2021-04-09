<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabeledByAndCreatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_inventories', function (Blueprint $table) {
            $table->integer('labeled_by')->unsigned()->default(0);
            $table->integer('created_by')->unsigned()->default(0);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_inventories', function (Blueprint $table) {
            $table->dropColumn('labeled_by');
            $table->dropColumn('created_by');
        });
    }
}
