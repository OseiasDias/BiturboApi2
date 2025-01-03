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
            $table->string('numero_produto')->unique();
            $table->date('data_compra');
            $table->string('nome', 255);
            $table->enum('galho', ['Galho Principal', 'Galho Secundário'])->default('Galho Principal');
            $table->string('fabricante');
            $table->decimal('preco', 10, 2);
            $table->string('unidade_medida');
            $table->string('fornecedor');
            $table->string('cor')->nullable();
            $table->string('garantia')->nullable();
            $table->string('imagem')->nullable();  // Para armazenar o nome ou caminho da imagem
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
