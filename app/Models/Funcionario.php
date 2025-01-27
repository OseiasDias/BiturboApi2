<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios'; // Define o nome da tabela
    protected $fillable = [
        'nome',
        'sobrenome',
        'dataNascimento',
        'email',
        'bilheteIdentidade',
        'nomeBanco',
        'iban',
        'foto',
        'genero',
        'celular',
        'telefoneFixo',
        'filial',
        'cargo',
        'dataAdmissao',
        'pais',
        'estado',
        'cidade',
        'endereco',
        'bloqueado'
    ]; // Define os campos que podem ser preenchidos
}
