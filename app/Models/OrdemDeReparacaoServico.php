<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeReparacaoServico extends Model
{
    use HasFactory;

    // Definir a tabela caso não seja nomeada automaticamente no plural
    protected $table = 'ordem_de_reparacao_servico';

    // Definir os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'ordem_de_reparacao_id',
        'servico_id',
    ];

    // Definir os relacionamentos
    public function ordemDeReparacao()
    {
        return $this->belongsTo(OrdemDeReparacao::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
