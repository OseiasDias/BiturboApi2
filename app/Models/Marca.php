<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo_veiculo_id',
    ];

    public function tipoVeiculo()
    {
        return $this->belongsTo(TipoVeiculo::class);
    }
}
