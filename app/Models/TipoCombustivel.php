<?php
// app/Models/TipoCombustivel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCombustivel extends Model
{
    use HasFactory;

    // Tabela associada ao modelo
    protected $table = 'tipos_combustiveis';

    // Campos que podem ser preenchidos
    protected $fillable = ['nome'];
}
