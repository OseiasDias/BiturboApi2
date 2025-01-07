<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renda extends Model
{
    use HasFactory;

    protected $fillable = [
        'fatura',
        'valor_pendente',
        'status',
        'rotulo_principal',
        'data_recebimento',
        'tipo_pagamento',
        'galho',
        'entrada_renda',
        'rotulo_renda',
    ];
}
