<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('tipo_veiculo'); // Tipo de veículo
            $table->string('numero_placa')->unique(); // Número da placa
            $table->string('marca_veiculo'); // Marca do veículo
            $table->string('modelo_veiculo'); // Nome do modelo
            $table->decimal('preco', 10, 2); // Preço
            $table->foreignId('cliente_id')->constrained('clientes'); // Relacionamento com o cliente
            $table->string('combustivel'); // Tipo de combustível
            $table->string('numero_equipamento')->nullable(); // Número de equipamento
            $table->string('ano_modelo')->nullable(); // Ano do modelo
            $table->string('leitura_odometro')->nullable(); // Leitura do odômetro
            $table->date('data_fabricacao')->nullable(); // Data de fabricação
            $table->string('caixa_velocidade')->nullable(); // Caixa de velocidade
            $table->string('numero_caixa')->nullable(); // Número da caixa de câmbio
            $table->string('numero_motor')->nullable(); // Número do motor
            $table->string('tamanho_motor')->nullable(); // Tamanho do motor
            $table->string('numero_chave')->nullable(); // Número da chave
            $table->string('motor')->nullable(); // Motor
            $table->string('numero_chassi')->nullable(); // Número do chassi
            $table->text('descricao')->nullable(); // Descrição
            $table->string('cor')->nullable(); // Cor
            $table->json('imagens')->nullable(); // Armazenar imagens como um array JSON
            $table->timestamps(); // created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
