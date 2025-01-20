<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'data_compra',
        'nome',
        'galho',
        'fabricante',
        'preco',
        'unidade_medida',
        'fornecedor',
        'garantia',
        'imagem',
        'nota',
        'nota_arquivos',
        'interna',
        'compartilhada'
    ];
}
