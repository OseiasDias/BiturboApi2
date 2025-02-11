<?php

namespace App\Http\Controllers;

use App\Models\Cronometro;
use Illuminate\Http\Request;

class CronometroController extends Controller
{
    // Método para listar todos os cronômetros
    public function index()
    {
        $cronometros = Cronometro::all();
        return response()->json($cronometros);
    }

    // Método para mostrar um cronômetro específico
    public function show($id)
    {
        $cronometro = Cronometro::find($id);

        if (!$cronometro) {
            return response()->json(['message' => 'Cronômetro não encontrado'], 404);
        }

        return response()->json($cronometro);
    }

    // Método para criar um novo cronômetro
    public function store(Request $request)
    {
        $request->validate([
            'NumeroOR' => 'required|string|max:255',
            'NumeroTecnico' => 'required|string|max:255',
            'segundosAtual' => 'required|integer',
            'segundoFinal' => 'required|integer',
            'numeroHoras' => 'required|integer',
            'rodando' => 'required|boolean',
            'estado' => 'required|string',
            'progresso' => 'required|integer',
            'nomeTecnico' => 'required|string|max:255',
            'defeito' => 'required|string',
            'acao' => 'required|string|max:255',
            'data_hora' => 'required|date',
            'TempoEsgotado' => 'required|boolean',
        ]);

        $cronometro = Cronometro::create($request->all());

        return response()->json($cronometro, 201);
    }

    // Método para atualizar os dados de um cronômetro
    public function update(Request $request, $id)
    {
        $cronometro = Cronometro::find($id);

        if (!$cronometro) {
            return response()->json(['message' => 'Cronômetro não encontrado'], 404);
        }

        $cronometro->update($request->all());

        return response()->json($cronometro);
    }

    // Método para excluir um cronômetro
    public function destroy($id)
    {
        $cronometro = Cronometro::find($id);

        if (!$cronometro) {
            return response()->json(['message' => 'Cronômetro não encontrado'], 404);
        }

        $cronometro->delete();

        return response()->json(['message' => 'Cronômetro excluído com sucesso']);
    }

    // Método para atualizar o progresso em tempo real
    public function updateProgress($id, Request $request)
    {
        $cronometro = Cronometro::find($id);

        if (!$cronometro) {
            return response()->json(['message' => 'Cronômetro não encontrado'], 404);
        }

        // Atualizando apenas o progresso e rodando
        $cronometro->progresso = $request->input('progresso');
        $cronometro->rodando = $request->input('rodando');

        // Se o tempo esgotou, definir o campo TempoEsgotado como verdadeiro
        if ($cronometro->segundosAtual >= $cronometro->segundoFinal) {
            $cronometro->TempoEsgotado = true;
        }

        $cronometro->save();

        return response()->json($cronometro);
    }
}
