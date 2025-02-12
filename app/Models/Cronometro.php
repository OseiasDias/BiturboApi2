<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronometro extends Model
{
    use HasFactory;

    // Nome da tabela (opcional, se seguir o padrão do Laravel)
    protected $table = 'cronometros';

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'numero_or',
        'tecnico_id',
        'segundos_atual',
        'segundo_final',
        'numero_horas',
        'rodando',
        'estado',
        'progresso',
        'ordem_reparacao_id',
        'acao',
        'tempo_esgotado',
    ];

    // Relacionamento com a tabela `funcionarios` (técnico)
    public function tecnico()
    {
        return $this->belongsTo(Funcionario::class, 'tecnico_id');
    }

    // Relacionamento com a tabela `ordem_de_reparacao`
    public function ordemReparacao()
    {
        return $this->belongsTo(OrdemDeReparacao::class, 'ordem_reparacao_id');
    }
}