<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos de forma massiva
    protected $fillable = [
        'primeiro_nome', 'ultimo_nome', 'nome_empresa', 'email', 'celular',
        'telefone_fixo', 'imagem', 'genero', 'pais', 'estado', 'municipio', 'endereco'
    ];

    // Caso precise de timestamps personalizados, defina a data de criação e atualização
    public $timestamps = true;
}
