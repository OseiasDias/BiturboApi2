
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('primeiro_nome');
            $table->string('sobrenome');
            $table->date('data_nascimento')->nullable();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->enum('genero', ['masculino', 'feminino']);
            $table->string('senha');
            $table->string('celular')->unique();
            $table->string('nome_exibicao')->nullable();
            $table->string('nome_empresa')->nullable();
            $table->string('telefone_fixo')->nullable();
            $table->string('nif')->nullable();
            $table->integer('id_pais');
            $table->string('id_provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->text('endereco');
            $table->integer('estado')->nullable(); // Campo "estado" adicionado
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
