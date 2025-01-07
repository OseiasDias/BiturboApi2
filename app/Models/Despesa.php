<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'rotulo_principal',
        'status',
        'data_recebimento',
        'galho',
        'entrada_despesa',
        'rotulo_despesa',
    ];
}
