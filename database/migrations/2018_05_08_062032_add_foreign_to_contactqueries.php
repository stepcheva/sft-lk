<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToContactqueries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contactqueries', function (Blueprint $table) {
            $table->integer('applicator_id')->unsigned()->nullable();
            $table->foreign('applicator_id')->references('id')->on('applicators')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('file_id')->unsigned()->nullable();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contactqueries', function (Blueprint $table) {
            $table->dropForeign(['applicator_id']);
            $table->dropForeign(['file_id']);
        });
    }
}
