<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_fatura',
        'cliente_id',
        'ordem_servico_id',  // Alterado para ordem_servico_id
        'veiculo_id',
        'valor_pago',
        'desconto',
        'data',
        'filial_id',
        'status',
        'tipo_pagamento',
        'valor_total',
        'detalhes',
        'tipo_fatura',
    ];

    // Relacionamento com a tabela 'clientes'
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com a tabela 'ordens_servico' (alterado de cartao_trabalho para ordem_servico)
    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);  // Relacionamento com a tabela ordens_servico
    }

    // Relacionamento com a tabela 'veiculos'
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    // Relacionamento com a tabela 'filiais'
    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }
}
