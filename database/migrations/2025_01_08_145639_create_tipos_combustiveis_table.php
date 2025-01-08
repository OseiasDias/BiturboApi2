<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_tipos_combustiveis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposCombustiveisTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_combustiveis', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do tipo de combustível
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_combustiveis');
    }
}
