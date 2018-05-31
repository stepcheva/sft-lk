<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductrangeIdToConsiignerDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consigneer_deliveries', function (Blueprint $table) {
            $table->integer('productrange_id')->unsigned()->nullable();
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
        Schema::table('consigneer_deliveries', function (Blueprint $table) {
            $table->dropForeign(['productrange_id']);
        });
    }
}
