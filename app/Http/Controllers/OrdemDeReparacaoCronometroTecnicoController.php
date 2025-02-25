<?php
namespace App\Http\Controllers;

use App\Models\OrdemDeReparacaoCronometroTecnico;
use Illuminate\Http\Request;

class OrdemDeReparacaoCronometroTecnicoController extends Controller
{
    // Mostrar todos os registros
    public function index()
    {
        $ordens = OrdemDeReparacaoCronometroTecnico::all();
        return response()->json($ordens);
    }

    // Mostrar um registro específico
    public function show($id)
    {
        $ordem = OrdemDeReparacaoCronometroTecnico::findOrFail($id);
        return response()->json($ordem);
    }

    // Criar um novo registro
    public function store(Request $request)
    {
        $data = $request->validate([
            'tecnico_id' => 'required|exists:funcionarios,id',
            'id_cronometro' => 'required|exists:cronometros,id',
            'ordem_reparacao_id' => 'required|exists:ordem_reparacoes,id',
            'numero_or' => 'required|string|max:255',
            'segundos_atual' => 'required|integer',
            'segundo_final' => 'required|integer',
            'numero_horas' => 'required|integer',
            'rodando' => 'required|boolean',
            'estado' => 'required|string|max:255',
            'progresso' => 'required|integer',
            'acao' => 'nullable|string|max:255',
            'data_hora' => 'required|date',
            'tempo_esgotado' => 'required|boolean',
        ]);

        $ordem = OrdemDeReparacaoCronometroTecnico::create($data);
        return response()->json($ordem, 201);
    }

    // Atualizar um registro
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tecnico_id' => 'required|exists:funcionarios,id',
            'id_cronometro' => 'required|exists:cronometros,id',
            'ordem_reparacao_id' => 'required|exists:ordem_reparacoes,id',
            'numero_or' => 'required|string|max:255',
            'segundos_atual' => 'required|integer',
            'segundo_final' => 'required|integer',
            'numero_horas' => 'required|integer',
            'rodando' => 'required|boolean',
            'estado' => 'required|string|max:255',
            'progresso' => 'required|integer',
            'acao' => 'nullable|string|max:255',
            'data_hora' => 'required|date',
            'tempo_esgotado' => 'required|boolean',
        ]);

        $ordem = OrdemDeReparacaoCronometroTecnico::findOrFail($id);
        $ordem->update($data);
        return response()->json($ordem);
    }

    // Excluir um registro
    public function destroy($id)
    {
        $ordem = OrdemDeReparacaoCronometroTecnico::findOrFail($id);
        $ordem->delete();
        return response()->json(null, 204);
    }
}
