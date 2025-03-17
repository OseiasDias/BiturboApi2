<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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

    // Removido o método boot() que fazia a criptografia da senha

    protected $hidden = [
        'password',
    ];
}
