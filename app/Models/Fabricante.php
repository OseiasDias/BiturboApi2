<?php
// app/Models/Fabricante.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory;

    // Tabela associada ao modelo
    protected $table = 'fabricantes';

    // Campos que podem ser preenchidos
    protected $fillable = ['nome'];
}
