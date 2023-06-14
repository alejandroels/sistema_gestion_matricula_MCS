<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evidencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->id('id');
            $table->String('Nombre');
            $table->String('Apellido');
            $table->integer('AnnoGraduado');
            $table->String('Direccion');
            $table->String('AreaTrabajo');
            $table->String('FotocopiaTitulo');
            $table->String('ActaSolicitud');
            $table->String('EdicionMaestria');
            $table->String('Estado')->default('nuevo');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        //
    }
}
