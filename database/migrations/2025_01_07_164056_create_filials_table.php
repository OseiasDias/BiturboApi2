<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilialsTable extends Migration
{
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id();
            $table->string('nome_filial', 50);
            $table->string('numero_contato', 16);
            $table->string('email', 50);
            $table->string('imagem')->nullable(); // Para armazenar o caminho da imagem
            $table->string('pais_id'); // String para o campo país
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->text('endereco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filials');
    }
}
