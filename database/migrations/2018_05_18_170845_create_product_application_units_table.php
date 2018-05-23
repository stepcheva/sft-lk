<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductApplicationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_application_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_number');
            $table->integer('volume');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('volume_decada');
            $table->integer('delivery_id');
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
        Schema::dropIfExists('product_application_units');
    }
}
