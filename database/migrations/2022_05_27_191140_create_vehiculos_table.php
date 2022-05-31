<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creditoid')->nullable()->index();
            $table->string('tipouso', 50)->nullable();
            $table->boolean('gps', 1)->nullable()->default('0');
			$table->string('marca', 50)->nullable();
			$table->string('modelo')->nullable();
			$table->string('color', 50)->nullable();
			$table->string('vin', 50)->nullable();
            $table->string('motor')->nullable();
            $table->string('chasis')->nullable();
            $table->string('anio', '10')->nullable();
            $table->string('placa', '50')->nullable();
            $table->boolean('estado_activo')->default(1);

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
        Schema::dropIfExists('vehiculos');
    }
}
