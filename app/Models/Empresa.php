<?php

// app/Models/Empresa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Defina a tabela associada ao modelo
    protected $table = 'empresas';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'nome_empresa', 'nif_empresa', 'tipo_empresa', 'setor_empresa',
        'site_empresa', 'telefone', 'email', 'rua', 'bairro', 
        'municipio', 'data_criacao',
    ];
}
