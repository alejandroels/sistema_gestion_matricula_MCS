<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Matricula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('Estado');
            $table->integer('NoRegistro')->nullable();
            $table->string('AreaTrabajo')->nullable();
            $table->string('FechaInicio')->nullable();
            $table->string('FechaFin')->nullable();
            $table->unsignedBigInteger('evidencia_id');
            $table->foreign('evidencia_id')->references('id')->on('evidencias');
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
