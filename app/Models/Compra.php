<?php

// app/Models/Compra.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_compra', 'galho', 'distribuidor_id', 'celular', 'email',
        'endereco', 'texto_nota', 'interna', 'compartilhada',
        'fabricante_id', 'produto_id', 'quantidade', 'preco', 'preco_total', 'nota_arquivos'
    ];

    // Relacionamentos
    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class);
    }

    public function galho()
    {
        return $this->belongsTo(Galho::class);
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
