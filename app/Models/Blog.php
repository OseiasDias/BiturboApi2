<?php
// app/Models/Blog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Blog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'conteudo', 'foto', 'data_publicacao', 'autor'];

    // Caso você queira configurar o tipo de data, você pode adicionar:
    protected $dates = ['data_publicacao'];
}
