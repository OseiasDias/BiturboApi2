<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeReparacaoTable extends Migration
{
    public function up()
    {
        Schema::create('ordem_de_reparacao', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('numero_trabalho'); // Número de trabalho
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade'); // Relacionamento com clientes
            $table->foreignId('veiculo_id')->constrained()->onDelete('cascade'); // Relacionamento com veículos
            $table->dateTime('data_inicial_entrada'); // Data e hora de entrada
            $table->string('categoria_reparo'); // Categoria do reparo (pane, veículo reservado, reparo repetido)
            $table->integer('km_entrada'); // KM de entrada
            $table->decimal('cobrar_reparo', 10, 2); // Valor a ser cobrado pelo reparo
            $table->string('filial'); // Filial onde o serviço será prestado
            $table->string('status', 100); // Status da ordem (transformado em string simples)
            $table->integer('garantia_dias'); // Garantia em dias
            $table->dateTime('data_final_saida'); // Data de saída final
            $table->text('detalhes')->nullable(); // Detalhes do reparo
            $table->text('defeito_ou_servico'); // Descrição do defeito ou serviço
            $table->text('observacoes')->nullable(); // Observações adicionais
            $table->text('laudo_tecnico')->nullable(); // Laudo técnico
            $table->longText('imagens')->nullable(); // Imagens do reparo
            $table->boolean('lavagem')->default(0); // Indica se houve lavagem do veículo
            $table->decimal('cobrar_lavagem', 10, 2)->nullable(); // Valor a ser cobrado pela lavagem
            $table->boolean('status_test_mot')->default(0); // Indica se o teste MOT foi feito
            $table->decimal('cobrar_test_mot', 10, 2)->nullable(); // Valor a ser cobrado pelo teste MOT
            $table->integer('horas_reparacao')->nullable(); // Horas de reparação
            $table->timestamps(); // Colunas created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_de_reparacao');
    }
}
