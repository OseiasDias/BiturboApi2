<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_funcionarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('nome');
            $table->string('sobrenome');
            $table->date('data_nascimento')->nullable();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->enum('genero', ['masculino', 'feminino']);
            $table->string('senha');
            $table->string('celular')->unique();
            $table->string('telefone_fixo')->nullable();
            $table->string('filial');
            $table->string('cargo');
            $table->string('nome_exibicao')->nullable();
            $table->date('data_admissao');
            $table->string('pais');
            $table->string('estado');
            $table->string('cidade');
            $table->text('endereco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}