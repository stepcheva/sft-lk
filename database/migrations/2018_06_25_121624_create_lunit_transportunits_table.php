<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunitTransportunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunit_transportunits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lunit_id')->unsigned();
            $table->foreign('lunit_id')->references('id')->on('lunits')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('transportunit_id')->unsigned();
            $table->foreign('transportunit_id')->references('id')->on('transportunits')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunit_transportunits');
    }
}
