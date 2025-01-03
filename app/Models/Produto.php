<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_produto', 'data_compra', 'nome', 'galho', 'fabricante', 'preco', 
        'unidade_medida', 'fornecedor', 'cor', 'garantia', 'imagem'
    ];

    // Caso queira tratar o campo de imagem como um arquivo
    public function setImagemAttribute($value)
    {
        if (is_file($value)) {
            // Aqui pode adicionar o código para armazenar a imagem, por exemplo, em uma pasta pública
            $this->attributes['imagem'] = $value->store('produtos', 'public');
        } else {
            $this->attributes['imagem'] = $value;
        }
    }
}
