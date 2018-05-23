<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToApplicators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicators', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('counter_id')->references('id')->on('counters')->onUpdate('cascade');
            $table->foreign('cooperation_id')->references('id')->on('cooperations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicators', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['counter_id']);
            $table->dropForeign(['cooperation_id']);
        });
    }
}
