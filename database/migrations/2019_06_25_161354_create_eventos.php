<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Eventos', function (Blueprint $table) {
            $table->increments('id_evento');
            $table->string('accion');
            $table->integer('responsable');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->string('observaciones');
            $table->integer('activo');
            $table->integer('estado');
            $table->string('archivo');
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
        Schema::drop('Eventos');
    }
}
