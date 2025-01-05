<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculos';

    protected $fillable = [
        'tipo_veiculo',
        'numero_placa',
        'marca_veiculo',
        'modelo_veiculo',
        'preco',
        'cliente_id',
        'combustivel',
        'numero_equipamento',
        'ano_modelo',
        'leitura_odometro',
        'data_fabricacao',
        'caixa_velocidade',
        'numero_caixa',
        'numero_motor',
        'tamanho_motor',
        'numero_chave',
        'motor',
        'numero_chassi',
        'descricao',
        'cor',
        'imagens',
    ];

    // Relacionamento com o Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
