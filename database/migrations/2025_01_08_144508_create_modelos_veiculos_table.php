<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_modelos_veiculos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosVeiculosTable extends Migration
{
    public function up()
    {
        Schema::create('modelos_veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do modelo do veículo
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('modelos_veiculos');
    }
}
