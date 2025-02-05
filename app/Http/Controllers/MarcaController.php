<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeReparacao;
use App\Models\Servico;
use App\Models\OrdemDeReparacaoServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdemDeReparacaoServicoController extends Controller
{
    // Retorna todos os serviços associados a uma ordem de reparação
    public function index($ordemDeReparacaoId)
    {
        $ordemDeReparacao = OrdemDeReparacao::find($ordemDeReparacaoId);

        if (!$ordemDeReparacao) {
            return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
        }

        // Retorna os serviços associados a esta ordem de reparação
        $servicos = $ordemDeReparacao->servicos;

        return response()->json($servicos);
    }

    // Associa serviços a uma ordem de reparação
    public function store(Request $request, $ordemDeReparacaoId)
    {
        $ordemDeReparacao = OrdemDeReparacao::find($ordemDeReparacaoId);

        if (!$ordemDeReparacao) {
            return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
        }

        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'servicos' => 'required|array', // Espera um array de IDs de serviços
            'servicos.*' => 'exists:servicos,id', // Valida se os IDs dos serviços existem na tabela `servicos`
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Associa os serviços à ordem de reparação
        foreach ($request->servicos as $servicoId) {
            OrdemDeReparacaoServico::create([
                'ordem_de_reparacao_id' => $ordemDeReparacaoId,
                'servico_id' => $servicoId,
            ]);
        }

        return response()->json(['message' => 'Serviços associados à ordem de reparação com sucesso!'], 201);
    }

    // Retorna um serviço específico de uma ordem de reparação
    public function show($ordemDeReparacaoId, $servicoId)
    {
        $ordemDeReparacao = OrdemDeReparacao::find($ordemDeReparacaoId);

        if (!$ordemDeReparacao) {
            return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
        }

        $servico = OrdemDeReparacaoServico::where('ordem_de_reparacao_id', $ordemDeReparacaoId)
            ->where('servico_id', $servicoId)
            ->first();

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado para esta ordem de reparação'], 404);
        }

        return response()->json($servico);
    }

    // Desassocia um serviço de uma ordem de reparação
    public function destroy($ordemDeReparacaoId, $servicoId)
    {
        $ordemDeReparacao = OrdemDeReparacao::find($ordemDeReparacaoId);

        if (!$ordemDeReparacao) {
            return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
        }

        $ordemDeReparacaoServico = OrdemDeReparacaoServico::where('ordem_de_reparacao_id', $ordemDeReparacaoId)
            ->where('servico_id', $servicoId)
            ->first();

        if (!$ordemDeReparacaoServico) {
            return response()->json(['message' => 'Serviço não encontrado para esta ordem de reparação'], 404);
        }

        // Desassocia o serviço
        $ordemDeReparacaoServico->delete();

        return response()->json(['message' => 'Serviço desassociado com sucesso!'], 200);
    }
}
