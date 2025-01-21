<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'galho',
        'fabricante_id',
        'preco',
        'unidade_medida',
        'distribuidor_id',
        'data_compra',
        'garantia',
        'imagem',  // Agora é uma string
        'nota',
        'interna',
        'compartilhada',
    ];

    // Relacionamento com Fabricante
    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }

    // Relacionamento com Distribuidor
    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class);
    }
}