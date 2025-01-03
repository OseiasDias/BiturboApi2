<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_compra',
        'data_compra',
        'distribuidors_id',
        'celular',
        'email',
        'endereco',
        'galho',
    ];
    
    // Defina relacionamentos se necessário
    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class);
    }
}
