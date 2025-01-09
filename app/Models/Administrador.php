<?php

// app/Models/Administrador.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    // Tabela associada ao modelo
    protected $table = 'administradores';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'nome', 'sobrenome', 'data_nascimento', 'email', 'foto', 'genero', 'senha',
        'celular', 'telefone_fixo', 'filial', 'cargo', 'nome_exibicao', 'data_admissao',
        'pais', 'estado', 'cidade', 'endereco',
    ];

    // Usar mutators para criptografar a senha
    protected $hidden = ['senha'];

    // Método para acessar a senha de forma segura
    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = bcrypt($value); // Criptografar a senha ao salvá-la
    }
}
