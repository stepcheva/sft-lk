<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductrangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productranges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('grammage');
            $table->string('format');
            $table->integer('price');
            $table->string('min_lot');
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
        Schema::dropIfExists('productranges');
    }
}
