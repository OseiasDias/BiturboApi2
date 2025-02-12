<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronometrosTable extends Migration
{
    public function up()
    {
        Schema::create('cronometros', function (Blueprint $table) {
            $table->id(); // ID auto-incremental
            $table->string('numero_or')->unique(); // Número da Ordem de Reparação (relacionado à tabela ordem_de_reparacao)
            $table->foreignId('tecnico_id')->constrained('funcionarios')->onDelete('cascade'); // Relacionamento com a tabela funcionarios (técnico responsável)
            $table->integer('segundos_atual')->default(0); // Tempo atual em segundos
            $table->integer('segundo_final')->default(0); // Segundo final para o cronômetro
            $table->integer('numero_horas')->default(0); // Número de horas
            $table->boolean('rodando')->default(false); // Se o cronômetro está rodando (booleano)
            $table->string('estado')->default('iniciado'); // Estado do cronômetro (iniciado, pausado, finalizado)
            $table->integer('progresso')->default(0); // Progresso do cronômetro (0 a 100)
            $table->foreignId('ordem_reparacao_id')->constrained('ordem_de_reparacao')->onDelete('cascade'); // Relacionamento com a tabela ordem_de_reparacao
            $table->string('acao', 255)->nullable(); // Ação do cronômetro
            $table->timestamp('data_hora')->useCurrent(); // Data e hora do registro (padrão para o horário atual)
            $table->boolean('tempo_esgotado')->default(false); // Se o tempo esgotou (booleano)
            $table->timestamps(); // Colunas created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cronometros');
    }
}