<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradoresTable extends Migration
{
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome');
            $table->date('data_nascimento')->nullable();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->enum('genero', ['masculino', 'feminino']);
            $table->string('password'); // 🔄 Alterado de 'senha' para 'password'
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
            $table->rememberToken(); // 🔄 Adicionado para autenticação
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administradores');
    }
}