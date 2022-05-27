<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clienteid')->nullable()->restrictOnUpdate()->restrictOnDelete();
			$table->bigInteger('estadocreditoid')->nullable()->index();
			$table->bigInteger('segmentoid')->nullable();
            $table->string('rut', 50)->nullable();
            $table->string('noperacion', 50)->nullable();
            $table->float('montototal', 10, 0)->nullable();
			$table->float('interes', 10, 0)->nullable();
			$table->dateTime('fechavencimiento')->nullable();
			$table->dateTime('fec_vencimiento_seguro')->nullable();
			$table->dateTime('fec_vencimiento_dispositivo')->nullable();
			$table->integer('ncuotas')->nullable();
			$table->float('valorcuota', 10, 0)->nullable();
            $table->float('saldoinsoluto', 10, 0)->nullable();
			$table->float('tasainteres', 10, 0)->nullable();
			$table->integer('diasdesfase')->nullable();
			$table->string('deviceid', 50)->nullable();
			$table->string('patente', 50)->nullable();
			$table->string('tipouso', 50)->nullable();
            $table->boolean('administrado', 1)->nullable()->default('1');
			$table->boolean('gps', 1)->nullable()->default('0');
			$table->string('marca', 50)->nullable();
			$table->string('modelo', 50)->nullable();
			$table->string('color', 50)->nullable();
			$table->string('vin', 50)->nullable();
            $table->string('creditOwnerAddress', 255)->nullable();
			$table->string('creditOwnerAddressJob', 255)->nullable();
			$table->string('creditOwnerCity', 50)->nullable();
			$table->string('creditOwnerEmail', 50)->nullable();
			$table->string('creditOwnerName', 50)->nullable();
			$table->string('creditOwnerPhone', 50)->nullable();
			$table->dateTime('datetimeReported')->nullable();
			$table->float('heading', 10, 0)->nullable();
			$table->dateTime('installationDate')->nullable();
			$table->float('lat', 10, 0)->nullable();
			$table->float('lng', 10, 0)->nullable();
			$table->float('odometer', 10, 0)->nullable();
			$table->float('speed', 10, 0)->nullable();
			$table->float('stopLat', 10, 0)->nullable();
			$table->integer('year')->nullable();
			$table->float('depreciationReal', 10, 0)->nullable();
			$table->dateTime('lastIntervalInfo')->nullable();
			$table->dateTime('lastDateReported')->nullable();
			$table->float('avg_odometer_by_day', 10, 0)->nullable();
			$table->string('proveedor', 50)->nullable();
			$table->string('aseguradora', 50)->nullable();
			$table->dateTime('fechaotorgamiento')->nullable();
			$table->float('lat_wa', 10, 0)->nullable();
			$table->float('lng_wa', 10, 0)->nullable();
            $table->boolean('estado_activo')->default(1);

            //relaciones entre tablas
            $table->foreign('clienteid')->references('id')->on('clientes');
            $table->foreign('estadocreditoid')->references('id')->on('estado_creditos');
            $table->foreign('segmentoid')->references('id')->on('segments');
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
        Schema::dropIfExists('creditos');
    }
}
