<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('manual_id')->unsigned();
            $table->foreign('manual_id')->references('id')->on('manuales');
            $table->timestamp('fecha_aprobada');
            $table->timestamp('fecha_premiada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estaciones');
    }
}
