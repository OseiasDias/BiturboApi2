<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->string('taxrate');
            $table->string('tax_number');
            $table->decimal('tax', 10, 2); // Para armazenar a taxa de imposto com duas casas decimais
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxas');
    }
}
