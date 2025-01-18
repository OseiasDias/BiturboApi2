<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_servico',
        'descricao',
        'preco', // Adicionando o campo 'preco' à propriedade fillable
    ];

    // Se você precisar de timestamps automáticos:
    public $timestamps = true;
}
