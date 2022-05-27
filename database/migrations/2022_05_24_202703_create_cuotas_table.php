<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->biginteger('creditoid')->nullable()->index();
            $table->bigInteger('estadocuotaid')->nullable()->index();
            $table->integer('numerocuota')->nullable();
            $table->float('saldoinsoluto', 10, 0)->nullable();
            $table->double('valorcuota', 8 ,2)->nullable();
            $table->datetime('fechavencimientocuota')->nullable();
            $table->boolean('estado_activo')->default(1);

            //relaciones entre tablas
            $table->foreign('creditoid')->references('id')->on('creditos');
            $table->foreign('estadocuotaid')->references('id')->on('estado_cuotas');
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
        Schema::dropIfExists('cuotas');
    }
}
