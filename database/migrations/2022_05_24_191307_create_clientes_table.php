<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('rut', 50);
            $table->string('nombre', 100)->nullable();
            $table->string('apaterno', 100)->nullable();
			$table->string('amaterno', 100)->nullable();
            $table->string('email')->nullable();
            $table->boolean('estado_activo')->default(1);    
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
        Schema::dropIfExists('clientes');
    }
}
