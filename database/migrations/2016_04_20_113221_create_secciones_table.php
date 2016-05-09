<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estacion_id')->unsigned();
            $table->foreign('estacion_id')->references('id')->on('estaciones');
            $table->integer('lider_cedula')->unsigned();
            $table->foreign('lider_cedula')->references('cedula')->on('lideres');
            $table->timestamp('fechaAprobada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('secciones');
    }
}
