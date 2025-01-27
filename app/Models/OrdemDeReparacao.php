<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeReparacao extends Model
{
    use HasFactory;

    protected $table = 'ordem_de_reparacao';

    protected $fillable = [
        'numero_trabalho', // jobno
        'cliente_id', // cust_id
        'veiculo_id', // vhi_id
        'data_inicial_entrada',
        'categoria_reparo', // repair_cat
        'km_entrada',
        'cobrar_reparo', // charge_required
        'filial', // branch
        'status',
        'garantia_dias',
        'data_final_saida',
        'detalhes', // details
        'defeito_ou_servico',
        'observacoes',
        'laudo_tecnico', // technical report
        'imagens', // images
        'lavagem', // washbay
        'cobrar_lavagem', // washBayCharge
        'status_test_mot', // motTestStatusCheckbox
        'cobrar_test_mot', // motTestCharge
    ];

    protected $casts = [
        'data_inicial_entrada' => 'datetime',
        'data_final_saida' => 'datetime',
        'cobrar_reparo' => 'decimal:2',
        'lavagem' => 'boolean',
        'status_test_mot' => 'boolean',
        'cobrar_test_mot' => 'decimal:2',
        'cobrar_lavagem' => 'decimal:2',
    ];
}
