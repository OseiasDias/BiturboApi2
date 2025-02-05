<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeReparacaoServico;
use Illuminate\Http\Request;

class OrdemDeReparacaoServicoController extends Controller
{
    // Listar todos os registros
    public function index()
    {
        $ordensDeReparacaoServico = OrdemDeReparacaoServico::all();
        return response()->json($ordensDeReparacaoServico);
    }

    // Exibir um registro específico
    public function show($id)
    {
        $ordemDeReparacaoServico = OrdemDeReparacaoServico::find($id);

        if (!$ordemDeReparacaoServico) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($ordemDeReparacaoServico);
    }

    // Criar um novo registro
    public function store(Request $request)
    {
        $request->validate([
            'ordem_de_reparacao_id' => 'required|exists:ordem_de_reparacao,id',
            'servico_id' => 'required|exists:servicos,id',
        ]);

        $ordemDeReparacaoServico = OrdemDeReparacaoServico::create([
            'ordem_de_reparacao_id' => $request->ordem_de_reparacao_id,
            'servico_id' => $request->servico_id,
        ]);

        return response()->json($ordemDeReparacaoServico, 201);
    }

    // Atualizar um registro
    public function update(Request $request, $id)
    {
        $ordemDeReparacaoServico = OrdemDeReparacaoServico::find($id);

        if (!$ordemDeReparacaoServico) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $request->validate([
            'ordem_de_reparacao_id' => 'required|exists:ordem_de_reparacao,id',
            'servico_id' => 'required|exists:servicos,id',
        ]);

        $ordemDeReparacaoServico->update([
            'ordem_de_reparacao_id' => $request->ordem_de_reparacao_id,
            'servico_id' => $request->servico_id,
        ]);

        return response()->json($ordemDeReparacaoServico);
    }

    // Deletar um registro
    public function destroy($id)
    {
        $ordemDeReparacaoServico = OrdemDeReparacaoServico::find($id);

        if (!$ordemDeReparacaoServico) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $ordemDeReparacaoServico->delete();

        return response()->json(['message' => 'Registro deletado com sucesso']);
    }
}
