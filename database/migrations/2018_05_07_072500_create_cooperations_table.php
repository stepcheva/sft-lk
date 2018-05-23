<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_number');
            $table->date('contract_period');
            $table->integer('monthly_min_volume');
            $table->integer('monthly_max_volume');
            $table->string('delayed_payment');
            $table->string('currency');
            $table->text('description')->nullable();
            $table->string('bonus')->nullable();
            $table->string('link_1s')->nullable();
            $table->integer('counter_id')->unsigned();
            $table->foreign('counter_id')->references('id')->on('counters')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cooperations');
    }
}
