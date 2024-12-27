<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // ID único do blog
            $table->string('titulo')->unique(); // Título do blog (agora é único)
            $table->text('conteudo')->unique(); // Conteúdo do blog (agora é único)
            $table->string('foto')->nullable(); // Foto opcional
            $table->timestamp('data_publicacao')->nullable(); // Data de publicação (pode ser NULL)
            $table->string('autor'); // Nome do autor
            $table->timestamps(); // Created_at e Updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
