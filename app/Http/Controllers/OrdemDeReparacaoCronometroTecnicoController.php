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
            'ordem_reparacao_id' => 'required|exists:ordem_de_reparacao,id',
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
            'ordem_reparacao_id' => 'required|exists:ordem_de_reparacao,id',
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

     // Novo método para obter idTecnico baseado no numero_or
     public function getIdTecnicoByNumeroOr($numeroOr)
     {
         // Procurar pela ordem de reparação que tem o numero_or
         $ordem = OrdemDeReparacaoCronometroTecnico::where('numero_or', $numeroOr)->first();
 
         // Verificar se foi encontrada uma ordem
         if ($ordem) {
             return response()->json(['idTecnico' => $ordem->tecnico_id]);
         } else {
             // Retornar erro caso a ordem não seja encontrada
             return response()->json(['message' => 'Ordem de Reparação não encontrada'], 404);
         }
     }

     // Novo método para atualizar o campo 'estado' baseado no numero_or
     public function updateEstadoByTecnicoAndNumeroOr(Request $request, $tecnico_id, $numeroOr)
     {
         // Validar os campos 'estado' no corpo da requisição
         $data = $request->validate([
             'estado' => 'required|string|max:255',
         ]);
     
         // Procurar pela ordem de reparação que tem o numero_or e o tecnico_id
         $ordem = OrdemDeReparacaoCronometroTecnico::where('numero_or', $numeroOr)
                                                      ->where('tecnico_id', $tecnico_id)
                                                      ->first();
     
         // Verificar se foi encontrada uma ordem
         if ($ordem) {
             // Atualizar o campo 'estado'
             $ordem->estado = $data['estado'];
             $ordem->save();
     
             // Retornar a ordem atualizada
             return response()->json($ordem);
         } else {
             // Retornar erro caso a ordem não seja encontrada
             return response()->json(['message' => 'Ordem de Reparação não encontrada ou técnico não corresponde'], 404);
         }
     }
     

        // Mostrar todos os registros, excluindo aqueles com o estado "terminado"
    public function listarOrdensAtivas()
    {
        $ordens = OrdemDeReparacaoCronometroTecnico::where('estado', '!=', 'Terminado')->get();
        return response()->json($ordens);
    }


}
