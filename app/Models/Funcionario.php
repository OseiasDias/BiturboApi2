<?php
// app/Models/Funcionario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Funcionario extends Model
{
    use HasFactory, Notifiable;

    // Defina o nome da tabela se ela não seguir a convenção (plurais, etc.)
    protected $table = 'funcionarios';

    // Atributos que podem ser preenchidos (protegendo contra mass assignment)
    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'foto',
        'genero',
        'senha',
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

    // Ações adicionais, como criptografar senha antes de salvar no banco
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('senha')) {
                $model->senha = Hash::make($model->senha);
            }
        });
    }
}
