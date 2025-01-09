<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_empresas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_empresa');
            $table->string('nif_empresa')->unique();
            $table->enum('tipo_empresa', ['Microempresa', 'Pequena Empresa', 'Média Empresa', 'Grande Empresa']);
            $table->string('setor_empresa');
            $table->string('site_empresa')->nullable();
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('rua');
            $table->string('bairro');
            $table->string('municipio');
            $table->date('data_criacao');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
