<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administrador extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'administradores';

    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'foto',
        'genero',
        'password',
        'celular',
        'telefone_fixo',
        'filial',
        'cargo',
        'nome_exibicao',
        'data_admissao',
        'pais',
        'estado',
        'cidade',
        'endereco',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
    ];
}
