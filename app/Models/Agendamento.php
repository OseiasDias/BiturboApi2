<?php
// app/Models/Agendamento.php

// app/Models/Agendamento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $table = 'agendamentos';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'data', 'id_cliente', 'id_veiculo', 'id_servico', 'status', 'descricao', 'motivoAdiar'
    ];

    // Relação com o cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Relação com o veículo
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculo');
    }

    // Relação com o serviço
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'id_servico');
    }
}
