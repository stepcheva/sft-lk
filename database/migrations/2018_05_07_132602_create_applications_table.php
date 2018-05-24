<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicator_id')->unsigned();
            $table->foreign('applicator_id')->references('id')->on('applicators')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('consigneer_id')->unsigned();
            $table->foreign('consigneer_id')->references('id')->on('consigneers')->onUpdate('cascade');

            $table->string('number',30)->unique();
            $table->date('period');

            $table->string('status')->default('new');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade');
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
        Schema::dropIfExists('applications');
    }
}
