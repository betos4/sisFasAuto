<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehiculoid')->nullable()->index();
            $table->string('deviceid', 50)->nullable();
            $table->dateTime('datetimeReported')->nullable();
            $table->float('heading', 10, 0)->nullable();
			$table->dateTime('installationDate')->nullable();
			$table->float('lat', 10, 0)->nullable();
			$table->float('lng', 10, 0)->nullable();
			$table->float('odometer', 10, 0)->nullable();
			$table->float('speed', 10, 0)->nullable();
			$table->float('stopLat', 10, 0)->nullable();
			$table->integer('year')->nullable();
            $table->dateTime('lastIntervalInfo')->nullable();
			$table->dateTime('lastDateReported')->nullable();
			$table->float('avg_odometer_by_day', 10, 0)->nullable();
			$table->string('proveedor', 50)->nullable();
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->nullable();
            $table->boolean('estado_activo')->default(1);

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
        Schema::dropIfExists('dispositivos');
    }
}
