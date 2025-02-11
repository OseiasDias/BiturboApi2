<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronometro extends Model
{
    use HasFactory;

    protected $table = 'cronometros';

    protected $fillable = [
        'NumeroOR', 
        'NumeroTecnico', 
        'segundosAtual', 
        'segundoFinal', 
        'numeroHoras', 
        'rodando', 
        'estado', 
        'progresso', 
        'nomeTecnico', 
        'defeito', 
        'acao', 
        'data_hora', 
        'TempoEsgotado'
    ];

    protected $casts = [
        'data_hora' => 'datetime',
        'rodando' => 'boolean',
        'TempoEsgotado' => 'boolean',
    ];
}
