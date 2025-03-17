
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{ 
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('primeiro_nome');
            $table->string('sobrenome');
            $table->string('celular');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bilhete_identidade')->nullable();
            $table->string('foto')->nullable();
            $table->enum('genero', ['masculino', 'feminino']);
            $table->string('nome_empresa')->nullable();
            $table->string('nif')->nullable();
            $table->string('telefone_fixo')->nullable();
            $table->string('pais');
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->text('endereco');
            $table->text('nota')->nullable();
            $table->boolean('bloqueado')->default(false);
            
            // Novas colunas
            $table->string('arquivo_nota')->nullable(); // Campo para os arquivos
            $table->boolean('interna')->default(false); // Checkbox para "Nota Interna"
            $table->boolean('compartilhado')->default(false); // Checkbox para "Compartilhado com fornecedor"
            
            // Adicionando a coluna 'numero_cliente'
            $table->string('numero_cliente')->unique(); // Campo para número do cliente
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}