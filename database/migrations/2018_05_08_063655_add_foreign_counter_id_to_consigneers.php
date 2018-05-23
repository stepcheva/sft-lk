<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignCounterIdToConsigneers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consigneers', function (Blueprint $table) {
            $table->integer('counter_id')->unsigned();
            $table->foreign('counter_id')->references('id')->on('counters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consigneers', function (Blueprint $table) {
            $table->dropForeign(['counter_id']);
        });
    }
}
