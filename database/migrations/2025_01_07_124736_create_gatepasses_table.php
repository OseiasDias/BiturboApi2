<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gatepasses', function (Blueprint $table) {
            $table->id();
            $table->string('jobcard');
            $table->string('gatepass_no')->unique();  // Definido como único
            $table->string('customer_name');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->string('vehicle_name');
            $table->string('veh_type');
            $table->string('chassis')->nullable();  // Pode ser nulo
            $table->integer('kms');  // Mudado para 'integer', pois é um valor numérico
            $table->date('out_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gatepasses');
    }
};
