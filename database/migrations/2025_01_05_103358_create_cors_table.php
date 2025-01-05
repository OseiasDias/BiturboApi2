<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorsTable extends Migration
{
    public function up()
    {
        Schema::create('cors', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique(); // Nome da cor
            $table->string('codigo_hex')->nullable(); // Código hexadecimal da cor (opcional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cors');
    }
}
