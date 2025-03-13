<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Cliente extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'primeiro_nome',
        'sobrenome',
        'celular',
        'email',
        'password',
        'bilhete_identidade',
        'foto',
        'genero',
        'nome_empresa',
        'nif',
        'telefone_fixo',
        'pais',
        'provincia',
        'municipio',
        'endereco',
        'nota',
        'bloqueado',
        'arquivo_nota',
        'interna',
        'compartilhado',
        'numero_cliente',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('password') && $model->password) {
                $model->password = Hash::make($model->password);
            }
        });
    }

    protected $hidden = [
        'password',
    ];
}
