<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero_compra')->unique();
            $table->date('data_compra');
            $table->foreignId('distribuidors_id')->constrained('distribuidors');
            $table->string('celular');
            $table->string('email');
            $table->text('endereco');
            $table->string('galho');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
