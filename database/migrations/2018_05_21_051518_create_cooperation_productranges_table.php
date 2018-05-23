<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationProductrangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperation_productranges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cooperation_id')->unsigned();
            $table->foreign('cooperation_id')->references('id')->on('cooperations')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('productrange_id')->unsigned();
            $table->foreign('productrange_id')->references('id')->on('productranges')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cooperation_productranges');
    }
}
