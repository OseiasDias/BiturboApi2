
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadeMedidasTable extends Migration
{
    public function up()
    {
        Schema::create('unidade_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('unidade', 100)->unique(); // Definindo tamanho de 100 e restringindo valores únicos
            $table->timestamps(); // Campos created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidade_medidas');
    }
}
