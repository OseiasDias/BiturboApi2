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
            $table->string('NumeroOR'); // Número da Ordem de Reparação
            $table->string('NumeroTecnico'); // Número do Técnico
            $table->integer('segundosAtual'); // Tempo atual em segundos
            $table->integer('segundoFinal'); // Segundo final para o cronômetro
            $table->integer('numeroHoras'); // Número de horas
            $table->boolean('rodando'); // Se o cronômetro está rodando (booleano)
            $table->string('estado'); // Estado do cronômetro
            $table->integer('progresso')->default(0); // Progresso do cronômetro
            $table->string('nomeTecnico'); // Nome do técnico
            $table->text('defeito'); // Descrição do defeito
            $table->string('acao', 255); // Ação do cronômetro
            $table->timestamp('data_hora')->useCurrent(); // Data e hora do registro (padrão para o horário atual)
            $table->boolean('TempoEsgotado')->default(false); // Se o tempo esgotou (booleano)
            $table->timestamps(); // Colunas created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cronometros');
    }
}
