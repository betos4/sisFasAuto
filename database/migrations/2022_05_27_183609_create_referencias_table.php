<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->id();
            $table->biginteger('clienteid')->nullable();
            $table->biginteger('tiporeferenciaid')->nullable();
            $table->string('rut', 50);
            $table->string('nombre', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('celular', 15)->nullable();
            $table->boolean('estado_activo')->default(1);  

            //relaciones entre tablas
            $table->foreign('clienteid')->references('id')->on('clientes');
            $table->foreign('tiporeferenciaid')->references('id')->on('tipo_referencias');
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
        Schema::dropIfExists('referencias');
    }
}
