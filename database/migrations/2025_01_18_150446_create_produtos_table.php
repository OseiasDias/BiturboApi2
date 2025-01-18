<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_produto')->unique(); // Número do produto (único)
            $table->date('data_compra'); // Data de compra
            $table->string('nome', 255); // Nome do produto
            $table->string('galho'); // Galho do produto
            $table->string('fabricante'); // Fabricante do produto
            $table->decimal('preco', 10, 2); // Preço do produto
            $table->string('unidade_medida'); // Unidade de medida do produto
            $table->string('fornecedor'); // Nome do fornecedor
            $table->string('cor')->nullable(); // Cor do produto (opcional)
            $table->string('garantia')->nullable(); // Garantia do produto (opcional)
            $table->string('imagem')->nullable();  // Imagem do produto (opcional)
            
            // Alterando 'nota' para tipo 'text' em vez de 'string'
            $table->text('nota')->default(''); // Nota como text, valor padrão ''
            $table->boolean('interna')->default(false); // Valor para "Nota Interna"
            $table->boolean('compartilhada')->default(false); // Valor para "Compartilhada"

            $table->timestamps(); // Timestamps de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos'); // Exclui a tabela 'produtos' se ela existir
    }
}
