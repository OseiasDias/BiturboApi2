<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricantesTable extends Migration
{
    public function up()
    {
        Schema::create('fabricantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();  // Adiciona a restrição de unicidade no campo 'nome'
            $table->timestamps(); // Para gerenciar os campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fabricantes');
    }
}
