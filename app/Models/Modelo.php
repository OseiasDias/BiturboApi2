<?php

// app/Models/Modelo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    // Tabela associada ao modelo
    protected $table = 'modelos_veiculos';

    // Campos que podem ser preenchidos
    protected $fillable = ['nome'];
}
