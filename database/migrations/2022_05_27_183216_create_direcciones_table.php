<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->biginteger('clienteid')->nullable();
            $table->biginteger('cantonid')->nullable();
            $table->string('direccion', 2500)->nullable();
            $table->string('sector')->nullable();
            $table->string('tipodireccion')->nullable();
            $table->boolean('estado_activo')->default(1);

            //relaciones entre tablas
            $table->foreign('clienteid')->references('id')->on('clientes');
            $table->foreign('cantonid')->references('id')->on('cantones');
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
        Schema::dropIfExists('direcciones');
    }
}
