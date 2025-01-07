<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendasTable extends Migration
{
    public function up()
    {
        Schema::create('rendas', function (Blueprint $table) {
            $table->id();
            $table->string('fatura');
            $table->decimal('valor_pendente', 10, 2)->nullable(); // Valor Pendentes
            $table->string('status'); // Status: Não remunerado, Parcialmente pago, Pago total
            $table->string('rotulo_principal');
            $table->date('data_recebimento');
            $table->string('tipo_pagamento'); // Tipos de Pagamento
            $table->string('galho');
            $table->decimal('entrada_renda', 10, 2); // Entrada de Renda
            $table->string('rotulo_renda')->nullable(); // Rótulo de Renda
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rendas');
    }
}
