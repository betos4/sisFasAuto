<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creditoid')->nullable()->restrictOnUpdate()->restrictOnDelete();
            $table->bigInteger('estadocuotaid')->nullable()->restrictOnUpdate()->restrictOnDelete();
            $table->string('plate', 50)->nullable();
            $table->date('date')->nullable();
            $table->enum('periodtype', ['DAY','WEEK','MONTH','QUARTER','YEAR'])->default('MONTH')->nullable();
            $table->string('period', 10)->nullable();
            $table->float('depreciation_real', 10,0)->nullable();
            $table->float('depreciation_expected', 10,0)->nullable();
            $table->dateTime('fechavencimiento')->nullable();
            $table->float('saldoinsoluto', 10, 0)->nullable();
            $table->float('odometer', 10, 0)->nullable();
            $table->float('avg_odometer_by_day', 10, 0)->nullable();
            $table->boolean('estado_activo')->default(1);

            //relaciones entre tablas
            $table->foreign('creditoid')->references('id')->on('creditos');
            $table->foreign('estadocuotaid')->references('id')->on('estado_cuotas');
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
        Schema::dropIfExists('reportes');
    }
}
