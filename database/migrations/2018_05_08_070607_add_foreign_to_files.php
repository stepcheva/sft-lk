<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->integer('applicator_id')->unsigned()->nullable();
            $table->foreign('applicator_id')->references('id')->on('applicators')->onDelete('set null')->onUpdate('cascade');

            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null')->onUpdate('cascade');

            $table->integer('lunit_id')->unsigned()->nullable();
            $table->foreign('lunit_id')->references('id')->on('lunits')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['applicator_id']);
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['lunit_id']);
        });
    }
}
