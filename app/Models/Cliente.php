<?php

// app/Models/Cliente.php

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
        'senha',
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
        'numero_cliente',  // Adicionando o campo numero_cliente
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
