<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConsumerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_orders', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->nullable()->after('id');

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumer_orders', function (Blueprint $table) {
            $table->dropForeign('consumer_orders_order_id_foreign');
            $table->dropColumn('order_id');
        });
    }
}
