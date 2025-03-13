<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administrador extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Tabela associada ao modelo
    protected $table = 'administradores';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'foto',
        'genero',
        'password', // 🔄 Alterado de 'senha' para 'password'
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
        'remember_token', // 🔄 Adicionado para autenticação persistente
    ];

    // Esconder campos sensíveis nas respostas JSON
    protected $hidden = ['password', 'remember_token'];

    // Mutator para criptografar a senha antes de salvar
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
