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
            $table->string('unidade', 50); // Coluna para a unidade de medida
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidade_medidas');
    }
}
