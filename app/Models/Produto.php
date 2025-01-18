<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos'; // Definir o nome da tabela, caso o nome não seja plural

    protected $fillable = [
        'numero_produto',
        'data_compra',
        'nome',
        'galho',
        'fabricante',
        'preco',
        'unidade_medida',
        'fornecedor',
        'cor',
        'garantia',
        'imagem',
        'nota',          // Adicionando o campo nota
        'interna',       // Adicionando o campo interna
        'compartilhada', // Adicionando o campo compartilhada
    ];

    // Caso precise de um formato personalizado para o campo data_compra
    protected $dates = ['data_compra'];

    // Para garantir que 'interna' e 'compartilhada' sejam interpretados como booleanos
    protected $casts = [
        'interna' => 'boolean',
        'compartilhada' => 'boolean',
    ];
}
