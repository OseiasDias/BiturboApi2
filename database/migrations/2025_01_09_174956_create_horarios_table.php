<?php

// database/migrations/{timestamp}_create_horarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('dia'); // Segunda, terça, etc.
            $table->time('abertura'); // Hora de abertura
            $table->time('fechamento'); // Hora de fechamento
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
