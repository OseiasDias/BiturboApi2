<?php

// database/migrations/2025_01_05_create_ordens_de_servico_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensDeServicoTable extends Migration
{
    public function up()
    {
        Schema::create('ordens_de_servico', function (Blueprint $table) {
            $table->id();
            $table->string('jobno');
            $table->unsignedBigInteger('cust_id');
            $table->unsignedBigInteger('vhi_id');
            $table->dateTime('data_inicial_entrada');
            $table->enum('repair_cat', ['breakdown', 'booked vehicle', 'repeat job', 'customer waiting']);
            $table->integer('km_entrada');
            $table->decimal('charge_required', 10, 2);
            $table->string('branch');
            $table->enum('status', ['pendente', 'em andamento', 'concluido']);
            $table->integer('garantia_dias');
            $table->dateTime('data_final_saida');
            $table->text('details')->nullable();
            $table->text('defeito_ou_servico');
            $table->text('observacoes')->nullable();
            $table->text('laudo_tecnico')->nullable();
            $table->json('images')->nullable();
            $table->boolean('washbay')->default(false);
            $table->decimal('washBayCharge', 10, 2)->nullable();
            $table->boolean('motTestStatusCheckbox')->default(false);
            $table->decimal('motTestCharge', 10, 2)->nullable();
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('cust_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('vhi_id')->references('id')->on('veiculos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordens_de_servico');
    }
}
