<?php
// database/migrations/xxxx_xx_xx_create_tipos_veiculos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoVeiculosTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // O tipo de veículo, como "Carro", "Moto", "Caminhão", etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_veiculos');
    }
}
