<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeReparacaoCronometroTecnicosTable extends Migration
{
    /**
     * Execute a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_de_reparacao_cronometro_tecnicos', function (Blueprint $table) {
            $table->id();  // ID autoincrementável para cada registro
            $table->unsignedBigInteger('tecnico_id');  // ID do técnico
            $table->unsignedBigInteger('id_cronometro');  // ID do cronômetro
            $table->unsignedBigInteger('ordem_reparacao_id'); // ID da ordem de reparação
            $table->string('numero_or', 255); // Número da ordem (varchar 255)
            $table->integer('segundos_atual')->default(0); // Segundos atuais (int)
            $table->integer('segundo_final')->default(0); // Segundo final (int)
            $table->integer('numero_horas')->default(0); // Número de horas (int)
            $table->boolean('rodando')->default(0); // Rodando (tinyint 1, 0 ou 1)
            $table->string('estado', 255)->default('iniciado'); // Estado (varchar 255)
            $table->integer('progresso')->default(0); // Progresso (int)
            $table->string('acao', 255)->nullable(); // Ação (nullable varchar 255)
            $table->timestamp('data_hora')->useCurrent(); // Data e hora (timestamp com valor atual)
            $table->boolean('tempo_esgotado')->default(0); // Tempo esgotado (tinyint 1, 0 ou 1)

            // Definição das chaves estrangeiras
            $table->foreign('tecnico_id')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('id_cronometro')->references('id')->on('cronometros')->onDelete('cascade');
            $table->foreign('ordem_reparacao_id')->references('id')->on('ordem_de_reparacao')->onDelete('cascade');

            $table->timestamps();  // Criar campos created_at e updated_at
        });
    }

    /**
     * Reverter a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordem_de_reparacao_cronometro_tecnicos');
    }
}
