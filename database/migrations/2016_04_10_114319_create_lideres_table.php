<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLideresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lideres', function (Blueprint $table) {
            $table->string('cedula');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fechaNacimiento');
            $table->char('sexo');
            $table->string('telefono');
            $table->string('email');
            $table->string('password');
            $table->integer('area_Id')->unsigned();
            $table->foreign('area_Id')->references('id')->on('areas');
            $table->integer('rol_Id')->unsigned();
            $table->foreign('rol_Id')->references('id')->on('roles');
            $table->string('liderGdc');
            $table->string('telefonoLiderGdc');
            
            $table->char('estatus');
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
        Schema::drop('lideres');
    }
}
