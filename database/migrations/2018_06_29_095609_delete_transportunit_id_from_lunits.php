<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTransportunitIdFromLunits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lunits', function (Blueprint $table) {
            $table->dropForeign(['transportunit_id']);
            $table->dropColumn('transportunit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lunits', function (Blueprint $table) {
            $table->integer('transportunit_id')->unsigned()->nullable();
            $table->foreign('transportunit_id')->references('id')->on('transportunits')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
