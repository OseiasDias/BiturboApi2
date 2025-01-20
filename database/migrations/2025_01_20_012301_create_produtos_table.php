<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->date('data_compra');
            $table->string('nome', 100); // Agora é 100 caracteres
            $table->string('galho'); // String simples
            $table->string('fabricante', 255);
            $table->decimal('preco', 10, 2);
            $table->string('unidade_medida', 255);
            $table->string('fornecedor', 255);
            $table->string('garantia', 100)->nullable(); // Máximo de 100 caracteres
            $table->string('imagem')->nullable(); // String para armazenar URL ou caminho da imagem
            $table->text('nota')->nullable();
            $table->text('nota_arquivos')->nullable(); // String simples para armazenar caminho/URL
            $table->boolean('interna')->default(false);
            $table->boolean('compartilhada')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
