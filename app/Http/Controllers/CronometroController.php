<?php

namespace App\Http\Controllers;

use App\Models\Cronometro;
use Illuminate\Http\Request;

class CronometroController extends Controller
{
    /**
     * Exibe uma lista de cronômetros.
     */
    public function index()
    {
        $cronometros = Cronometro::with(['tecnico', 'ordemReparacao'])->get();
        return response()->json($cronometros);
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'numero_or' => 'required|string|unique:cronometros',
            'tecnico_id' => 'required|exists:funcionarios,id',
            'segundos_atual' => 'required|integer',
            'segundo_final' => 'required|integer',
            'numero_horas' => 'required|integer',
            'rodando' => 'required|boolean',
            'estado' => 'required|string',
            'progresso' => 'required|integer',
            'ordem_reparacao_id' => 'required|exists:ordem_de_reparacao,id',
            'acao' => 'nullable|string',
            'tempo_esgotado' => 'required|boolean',
        ]);

        $cronometro = Cronometro::create($request->all());
        return response()->json($cronometro, 201);
    }

    /**
     * Exibe os detalhes de um cronômetro específico.
     */
    public function show($id)
    {
        $cronometro = Cronometro::with(['tecnico', 'ordemReparacao'])->findOrFail($id);
        return response()->json($cronometro);
    }

    /**
     * Atualiza um cronômetro no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_or' => 'sometimes|string|unique:cronometros,numero_or,' . $id,
            'tecnico_id' => 'sometimes|exists:funcionarios,id',
            'segundos_atual' => 'sometimes|integer',
            'segundo_final' => 'sometimes|integer',
            'numero_horas' => 'sometimes|integer',
            'rodando' => 'sometimes|boolean',
            'estado' => 'sometimes|string',
            'progresso' => 'sometimes|integer',
            'ordem_reparacao_id' => 'sometimes|exists:ordem_de_reparacao,id',
            'acao' => 'nullable|string',
            'tempo_esgotado' => 'sometimes|boolean',
        ]);

        $cronometro = Cronometro::findOrFail($id);
        $cronometro->update($request->all());
        return response()->json($cronometro);
    }

    /**
     * Remove um cronômetro do banco de dados.
     */
    public function destroy($id)
    {
        $cronometro = Cronometro::findOrFail($id);
        $cronometro->delete();
        return response()->json(null, 204);
    }


    /**
     * Pesquisa o cronômetro pelo número da ordem de reparação e retorna o ID.
     */
    public function buscarPorNumeroOr($numero_or) 
    {
        // Busca o cronômetro pelo número da ordem de reparação
        $cronometro = Cronometro::where('numero_or', $numero_or)->first(); 
        // Verifica se o cronômetro foi encontrado
        if (!$cronometro) {
            return response()->json(['message' => 'Cronômetro não encontrado.'], 404);
        }    
        // Retorna o tecnico_id em vez do id do cronômetro
        return response()->json(['tecnico_id' => $cronometro->tecnico_id]);
    }

            // Mostrar todos os registros, excluindo aqueles com o estado "terminado"
            public function listarOrdensAtivas()
            {
                $ordens = OrdemDeReparacaoCronometroTecnico::where('estado', '!=', 'Terminado0')->get();
                return response()->json($ordens);
            }
        
    
}