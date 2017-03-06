<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('consumer_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('reference');
            $table->date('month');
            $table->boolean('is_test_program')->default(false);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('consumer_orders_products', function (Blueprint $table) {
            $table->unsignedInteger('consumer_order_id');
            $table->unsignedInteger('product_id');
            $table->smallInteger('quantity');
            $table->boolean('from_stock')->default(false);

            $table->foreign('consumer_order_id')->references('id')->on('consumer_orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('consumer_orders_products');
        Schema::drop('consumer_orders');
    }
}
