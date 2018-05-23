<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToProductApplicationUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_application_units', function (Blueprint $table) {
            $table->integer('product_application_id')->unsigned()->nullable();
            $table->foreign('product_application_id')->references('id')->on('product_applications')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lunits_id')->unsigned()->nullable();
            $table->foreign('lunits_id')->references('id')->on('lunits')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_application_units', function (Blueprint $table) {
            $table->dropForeign(['product_application_id']);
            $table->dropForeign(['lunits_id']);
        });
    }
}
