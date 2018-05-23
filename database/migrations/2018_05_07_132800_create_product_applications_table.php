<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');

            $table->integer('productrange_id')->unsigned();
            $table->foreign('productrange_id')->references('id')->on('productranges')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('consigneer_delivery_id')->unsigned();
            $table->foreign('consigneer_delivery_id')->references('id')->on('consigneer_delivery')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('product_applications');
    }
}
