<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('email');
            $table->string('telefono');
            $table->bigInteger('idNivel_formacion')->unsigned();
            $table->foreign('idNivel_formacion')->references('id')->on('nivel_formacions');
            $table->bigInteger('idPrograma')->unsigned();
            $table->foreign('idPrograma')->references('id')->on('programas');
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
        Schema::dropIfExists('visitantes');
    }
}
