<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creditoid')->nullable();
            $table->string('numcontrato', 50);
            $table->string('tipocontrato', 50);
            $table->float('valorgarantia', 10, 2);
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->nullable();
            $table->string('pathidentificacion')->nullable();
            $table->string('pathplanilla')->nullable();
            $table->string('pathfacturavehiculo')->nullable();
            $table->string('pathfacturacontrato')->nullable();
            $table->string('pathtablaamortizacion')->nullable();
            $table->string('pathpagare')->nullable();

            //relaciones entre tablas
            $table->foreign('creditoid')->references('id')->on('creditos');
            $table->timestamps(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
