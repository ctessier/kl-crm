<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate')->nullable();
            $table->char('sex', 1)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('consumer_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('description')->nullable();
        });

        Schema::create('consumers_consumer_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consumer_id');
            $table->unsignedInteger('status_id');
            $table->date('date');

            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('status_id')->references('id')->on('consumer_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('consumers_consumer_statuses');
        Schema::drop('consumer_statuses');
        Schema::drop('consumers');
    }
}
