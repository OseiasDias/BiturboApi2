<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    // Definir os campos que podem ser preenchidos
    protected $fillable = [
        'nome_filial',
        'numero_contato',
        'email',
        'imagem',
        'pais_id',
        'provincia',
        'municipio',
        'endereco',
    ];

    // Caso precise de relacionamento com outros modelos, adicione aqui.
}
