<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehiculoid')->nullable()->index();
            $table->string('nombre')->nullable();
            $table->string('numseguro', '50')->nullable();
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->nullable();

            //relaciones entre tablas
            $table->foreign('vehiculoid')->references('id')->on('vehiculos');
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
        Schema::dropIfExists('seguros');
    }
}
