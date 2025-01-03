<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Cliente extends Model
{
    use HasFactory, Notifiable;

    // Nome da tabela no banco de dados
    protected $table = 'clientes';

    // Campos que podem ser preenchidos massivamente
    protected $fillable = [
        'primeiro_nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'senha',
        'celular',
        'foto',
        'genero',
        'nome_exibicao',
        'nome_empresa',
        'telefone_fixo',
        'nif',
        'id_pais',
        'id_provincia',
        'municipio',
        'endereco',
        'estado',
    ];

    // Criptografar a senha antes de salvar
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('senha')) {
                $model->senha = Hash::make($model->senha);
            }
        });
    }
}
