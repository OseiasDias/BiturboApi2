<?php
// app/Models/Horario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos de forma massiva
    protected $fillable = [
        'dia', 'abertura', 'fechamento',
    ];
}
