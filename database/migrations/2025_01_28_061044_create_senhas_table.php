<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_senhas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenhasTable extends Migration
{
    public function up()
    {
        Schema::create('senhas', function (Blueprint $table) {
            $table->id();  // ID da senha
            $table->string('senha');  // Campo para armazenar a senha
            $table->timestamps();  // Data de criação e atualização
        });
    }

    public function down()
    {
        Schema::dropIfExists('senhas');
    }
}
