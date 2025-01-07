<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->string('rotulo_principal');  // Rótulo principal da despesa
            $table->string('status');            // Status da despesa
            $table->date('data_recebimento');   // Data em que a despesa foi paga
            $table->string('galho');             // Galho/filial
            $table->decimal('entrada_despesa', 10, 2);  // Valor da despesa
            $table->string('rotulo_despesa')->nullable(); // Rótulo de despesa opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
