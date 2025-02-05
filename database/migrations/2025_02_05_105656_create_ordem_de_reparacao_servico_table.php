<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeReparacaoServicoTable extends Migration
{
    public function up()
    {
        Schema::create('ordem_de_reparacao_servico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_de_reparacao_id')
                ->constrained('ordem_de_reparacao')
                ->onDelete('cascade'); // Relaciona com a tabela ordem_de_reparacao
            $table->foreignId('servico_id')
                ->constrained('servicos')
                ->onDelete('cascade'); // Relaciona com a tabela servicos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_de_reparacao_servico');
    }
}
