<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('decada');
            $table->integer('volume');
            $table->integer('price');
            $table->integer('productrange_id')->unsigned();
            $table->foreign('productrange_id')->references('id')->on('productranges')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lunit_id')->unsigned();
            $table->foreign('lunit_id')->references('id')->on('lunits')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
