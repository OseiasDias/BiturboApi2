<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemDeReparacaoTable extends Migration
{
    public function up()
    {
        Schema::create('ordem_de_reparacao', function (Blueprint $table) {
            $table->id();
            $table->string('numero_trabalho'); // jobno
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade'); // cust_id
            $table->foreignId('veiculo_id')->constrained()->onDelete('cascade'); // vhi_id
            $table->dateTime('data_inicial_entrada');
            $table->enum('categoria_reparo', ['pane', 'veículo reservado', 'reparo repetido']); // repair_cat
            $table->integer('km_entrada');
            $table->decimal('cobrar_reparo', 10, 2); // charge_required
            $table->string('filial');
            $table->enum('status', ['pendente', 'em andamento', 'concluido']);
            $table->integer('garantia_dias');
            $table->dateTime('data_final_saida');
            $table->text('detalhes')->nullable(); // details
            $table->text('defeito_ou_servico');
            $table->text('observacoes')->nullable();
            $table->text('laudo_tecnico')->nullable(); // technical report
            $table->longText('imagens')->nullable(); // images
            $table->boolean('lavagem')->default(0); // washbay
            $table->decimal('cobrar_lavagem', 10, 2)->nullable(); // washBayCharge
            $table->boolean('status_test_mot')->default(0); // motTestStatusCheckbox
            $table->decimal('cobrar_test_mot', 10, 2)->nullable(); // motTestCharge
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_de_reparacao');
    }
}
