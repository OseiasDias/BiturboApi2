<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos'; // Definir o nome da tabela, caso o nome não seja plural

    protected $fillable = [
        'numero_produto',
        'data_compra',
        'nome',
        'galho',
        'fabricante',
        'preco',
        'unidade_medida',
        'fornecedor',
        'cor',
        'garantia',
        'imagem',
    ];

    // Caso precise de um formato personalizado para o campo data_compra
    protected $dates = ['data_compra'];
}
