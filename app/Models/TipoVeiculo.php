<?php

// app/Models/TipoVeiculo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVeiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
    ];
}
