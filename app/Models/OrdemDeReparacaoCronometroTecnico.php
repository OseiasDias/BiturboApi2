<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeReparacaoCronometroTecnico extends Model
{
    use HasFactory;

    // Definir a tabela
    protected $table = 'ordem_de_reparacao_cronometro_tecnicos';

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'tecnico_id',
        'id_cronometro',
        'ordem_reparacao_id',
        'numero_or',
        'segundos_atual',
        'segundo_final',
        'numero_horas',
        'rodando',
        'estado',
        'progresso',
        'acao',
        'data_hora',
        'tempo_esgotado',
    ];

    // Relacionamento com o técnico
    public function tecnico()
    {
        return $this->belongsTo(Funcionario::class, 'tecnico_id');
    }

    // Relacionamento com o cronômetro
    public function cronometro()
    {
        return $this->belongsTo(Cronometro::class, 'id_cronometro');
    }

    // Relacionamento com a ordem de reparação
    public function ordemReparacao()
    {
        return $this->belongsTo(OrdemDeReparacao::class, 'ordem_reparacao_id');
    }

    // Definir acessores, se necessário
    // Exemplo: Para obter o valor do 'estado' em formato mais legível
    public function getEstadoAttribute($value)
    {
        return ucfirst($value); // Exemplo: retorna o estado com a primeira letra maiúscula
    }
}

