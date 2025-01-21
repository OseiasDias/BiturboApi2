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
            $table->string('nome');
            $table->string('galho');
            $table->foreignId('fabricante_id')->constrained('fabricantes')->onDelete('cascade');
            $table->decimal('preco', 10, 2);
            $table->string('unidade_medida');
            $table->foreignId('distribuidor_id')->constrained('distribuidors')->onDelete('cascade');
            $table->date('data_compra');
            $table->string('garantia')->nullable();
            $table->string('imagem')->nullable();  // Agora é uma string normal
            $table->text('nota')->nullable();
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
