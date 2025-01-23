<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'sobrenome', 'dataNascimento', 'email', 'bilheteIdentidade', 'nomeBanco',
        'iban', 'senha', 'foto', 'genero', 'celular', 'telefoneFixo', 'filial', 'cargo',
        'nomeExibicao', 'dataAdmissao', 'pais', 'estado', 'cidade', 'endereco', 'bloqueado'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('senha')) {
                $model->senha = Hash::make($model->senha);
            }
        });
    }

    protected $hidden = [
        'senha',
    ];
}
