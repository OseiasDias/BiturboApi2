<?php

// app/Models/OrdemDeServico.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeServico extends Model
{
    use HasFactory;

    protected $table = 'ordens_de_servico';  // Nome da tabela no banco de dados

    protected $fillable = [
        'jobno',
        'cust_id',
        'vhi_id',
        'data_inicial_entrada',
        'repair_cat',
        'km_entrada',
        'charge_required',
        'branch',
        'status',
        'garantia_dias',
        'data_final_saida',
        'details',
        'defeito_ou_servico',
        'observacoes',
        'laudo_tecnico',
        'images',
        'washbay',
        'washBayCharge',
        'motTestStatusCheckbox',
        'motTestCharge'
    ];

    // Relacionamento com a tabela de clientes
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cust_id');
    }

    // Relacionamento com a tabela de veículos
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'vhi_id');
    }
}
