
<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_agendamentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id('id');
            $table->dateTime('data');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_veiculo');
            $table->unsignedBigInteger('id_servico');
            $table->string('status');
            $table->text('descricao')->nullable();
            $table->text('motivoAdiar')->nullable();
            $table->timestamps();

            // Relacionamentos com outras tabelas
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_veiculo')->references('id')->on('veiculos')->onDelete('cascade');
            $table->foreign('id_servico')->references('id')->on('servicos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}