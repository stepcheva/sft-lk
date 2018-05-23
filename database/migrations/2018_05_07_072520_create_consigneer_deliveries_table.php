<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsigneerDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consigneer_deliveries', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('consigneer_id')->unsigned();
            $table->foreign('consigneer_id')->references('id')->on('consigneers')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('delivery_id')->unsigned();
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price')->nullable();
            $table->string('link_1s')->nullable();
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
        Schema::dropIfExists('consigneer_deliveries');
    }
}
