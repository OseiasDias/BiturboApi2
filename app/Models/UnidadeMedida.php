<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeMedida extends Model
{
    use HasFactory;

    protected $fillable = ['unidade']; // Os campos que podem ser preenchidos

    // Não precisa de regras de relacionamento aqui, porque a tabela não possui relacionamentos
}
