<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{ 
    use HasFactory;

    // Especifica os campos que podem ser preenchidos (mass assignment)
    protected $fillable = ['password'];

    // Remove a lógica de criptografia ao salvar a senha
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Não aplica criptografia, apenas armazena como texto puro
        });
    }

    // Remove a ocultação da senha ao retornar dados da API (opcional)
    protected $hidden = []; // Se quiser exibir a senha na API, deixe vazio
}
