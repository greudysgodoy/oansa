<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOansistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oansistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fechaNacimiento');
            $table->integer('grado');
            $table->char('sexo');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('representante');
            $table->string('telefonoRepresentante');
            $table->string('iglesia');
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
        Schema::drop('oansistas');
    }
}
