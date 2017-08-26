<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('capacity');
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('quantity_per_box');
            $table->unsignedInteger('box_type_id')->after('name');

            $table->foreign('box_type_id')->references('id')->on('box_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_box_type_id_foreign');
            $table->dropColumn('box_type_id');
        });

        Schema::dropIfExists('box_types');
    }
}
