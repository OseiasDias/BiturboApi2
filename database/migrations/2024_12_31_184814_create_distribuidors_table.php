<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribuidorsTable extends Migration
{
    public function up()
    {
        Schema::create('distribuidors', function (Blueprint $table) {
            $table->id(); // ID único do distribuidor
            $table->string('primeiro_nome'); // Primeiro nome do distribuidor
            $table->string('ultimo_nome'); // Último nome do distribuidor
            $table->string('nome_empresa'); // Nome da empresa
            $table->string('email')->unique(); // E-mail único do distribuidor
            $table->string('celular')->unique(); // Celular único
            $table->string('telefone_fixo')->nullable(); // Telefone fixo (opcional)
            $table->string('imagem')->nullable(); // Imagem (opcional)
            $table->enum('genero', ['Masculino', 'Feminino'])->nullable(); // Gênero
            $table->string('pais'); // País
            $table->string('estado')->nullable(); // Estado
            $table->string('municipio')->nullable(); // Município
            $table->text('endereco'); // Endereço completo
            $table->timestamps(); // Created_at e Updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('distribuidors');
    }
}
