<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_compras_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->date('data_compra');
            $table->unsignedBigInteger('filial_id'); // Alterado para filial_id
            $table->unsignedBigInteger('distribuidor_id');
            $table->string('celular');
            $table->string('email');
            $table->text('endereco');
            $table->text('texto_nota')->nullable();
            $table->boolean('interna')->default(false);
            $table->boolean('compartilhada')->default(false);
            
            // Relacionamentos com fabricantes e produtos
            $table->unsignedBigInteger('fabricante_id')->nullable();
            $table->unsignedBigInteger('produto_id')->nullable();
            $table->integer('quantidade')->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->decimal('preco_total', 10, 2)->nullable();

            // Alteração do tipo para string em vez de json
            $table->string('nota_arquivos')->nullable(); // Tipo string para nota_arquivos
            
            $table->timestamps();

            // Relacionamentos
            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('distribuidor_id')->references('id')->on('distribuidores');
            $table->foreign('fabricante_id')->references('id')->on('fabricantes')->nullable();
            $table->foreign('produto_id')->references('id')->on('produtos')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}

