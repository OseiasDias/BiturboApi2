<?php

// app/Http/Controllers/HorariosController.php
// app/Http/Controllers/HorariosController.php
// app/Http/Controllers/HorariosController.php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    // Função para salvar os horários
    public function store(Request $request)
    {
        $request->validate([
            'horarios' => 'required|array',
            'horarios.*.abertura' => 'required|date_format:H:i',
            'horarios.*.fechamento' => 'required|date_format:H:i|after:horarios.*.abertura',
        ]);

        // Salva os horários de cada dia da semana
        foreach ($request->horarios as $dia => $horario) {
            Horario::create([
                'dia' => $dia,
                'abertura' => $horario['abertura'],
                'fechamento' => $horario['fechamento'],
            ]);
        }

        return response()->json(['message' => 'Horários de funcionamento salvos com sucesso!']);
    }

    // Função para exibir os horários
    public function show()
    {
        $horarios = Horario::all();
        return response()->json($horarios);
    }

    // Função para atualizar os horários
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'abertura' => 'required|date_format:H:i',
            'fechamento' => 'required|date_format:H:i|after:abertura',
        ]);

        // Encontrar o horário pelo ID
        $horario = Horario::find($id);

        // Verificar se o horário foi encontrado
        if (!$horario) {
            return response()->json(['message' => 'Horário não encontrado!'], 404);
        }

        // Atualizar os dados de abertura e fechamento
        $horario->abertura = $request->abertura;
        $horario->fechamento = $request->fechamento;
        $horario->save();  // Salvar as alterações no banco de dados

        return response()->json(['message' => 'Horário de funcionamento atualizado com sucesso!']);
    }
}
