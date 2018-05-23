<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('consigneer_id');
            $table->text('transportunits_info');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('volume_decada');
            $table->integer('volume');
            $table->date('plan_data');
            $table->date('shipment_data');
            $table->date('delivery_data');
            $table->integer('price');
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
        Schema::dropIfExists('lunits');
    }
}
