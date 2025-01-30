<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_funcionario')->unique();  // Campo para o número do funcionário (adicionado)
            $table->string('nome');
            $table->string('sobrenome');
            $table->date('dataNascimento');
            $table->string('email')->unique();
            $table->string('bilheteIdentidade');
            $table->string('nomeBanco')->nullable();
            $table->string('iban')->nullable();
            $table->string('foto')->nullable();
            $table->enum('genero', ['masculino', 'feminino']);
            $table->string('celular');
            $table->string('telefoneFixo')->nullable();
            $table->string('filial');
            $table->string('cargo');
            $table->date('dataAdmissao');
            $table->string('pais');
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->text('endereco');
            $table->boolean('bloqueado')->default(false); // Adicionado o campo bloqueado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}