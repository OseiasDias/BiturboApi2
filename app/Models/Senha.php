<?php

// app/Models/Senha.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Senha extends Model
{
    use HasFactory;

    // Especifica os campos que podem ser preenchidos (mass assignment)
    protected $fillable = ['password'];

    // Sempre que a senha for salva, ela será automaticamente criptografada
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('password')) {
                $model->password = Hash::make($model->password);
            }
        });
    }

    // Oculta o campo password ao retornar dados da API
    protected $hidden = ['password'];
}
