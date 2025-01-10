<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id(); 
            $table->string('numero_fatura')->unique();
            $table->foreignId('cliente_id')->constrained('clientes');  // Referência à tabela de clientes
            $table->foreignId('ordem_servico_id')->constrained('ordens_de_servico');  // Alterado para ordem_servico_id, refere-se à tabela 'ordens_de_servico'
            $table->foreignId('veiculo_id')->constrained('veiculos'); // Referência à tabela de veículos
            $table->decimal('valor_pago', 10, 2);
            $table->decimal('desconto', 5, 2)->nullable();
            $table->date('data');
            $table->string('filiais'); 
           // $table->foreignId('filial_id')->constrained('filiais'); // Referência à tabela de filiais
            $table->string('status');  // Alterado para string
            $table->string('tipo_pagamento');  // Alterado para string
            $table->decimal('valor_total', 10, 2);
            $table->text('detalhes')->nullable();
            $table->string('tipo_fatura');  // Alterado para string
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
