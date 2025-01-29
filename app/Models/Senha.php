<?php

// app/Models/Senha.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senha extends Model
{
    use HasFactory;

    // Especifica os campos que podem ser preenchidos (mass assignment)
    protected $fillable = ['senha'];
}
