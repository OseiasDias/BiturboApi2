<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeReparacao;
use Illuminate\Http\Request;

class OrdemDeReparacaoController extends Controller
{
    public function index()
    {
        $ordens = OrdemDeReparacao::all();
        return response()->json($ordens);
    }

    public function show($id)
    {
        $ordem = OrdemDeReparacao::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem não encontrada'], 404);
        }

        return response()->json($ordem);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_trabalho' => 'required|string|max:255',
            'cliente_id' => 'required|integer',
            'veiculo_id' => 'required|integer',
            'data_inicial_entrada' => 'required|date',
            'categoria_reparo' => 'required|string',
            'km_entrada' => 'required|integer',
            'cobrar_reparo' => 'required|numeric',
            'filial' => 'required|string|max:255',
            'status' => 'required|string',
            'garantia_dias' => 'required|integer',
            'data_final_saida' => 'required|date',
            'defeito_ou_servico' => 'required|string',
        ]);

        $ordem = OrdemDeReparacao::create($request->all());

        return response()->json($ordem, 201);
    }

    public function update(Request $request, $id)
    {
        $ordem = OrdemDeReparacao::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem não encontrada'], 404);
        }

        $ordem->update($request->all());

        return response()->json($ordem);
    }

    public function destroy($id)
    {
        $ordem = OrdemDeReparacao::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem não encontrada'], 404);
        }

        $ordem->delete();

        return response()->json(['message' => 'Ordem excluída com sucesso']);
    }

     

     public function getMaxId()
{
    // Obtendo o maior ID da tabela
    $maxId = OrdemDeReparacao::max('id');

    // Verificando se existe algum ID (caso contrário, a tabela pode estar vazia)
    if ($maxId !== null) {
        return response()->json(['max_id' => $maxId]);
    } else {
        // Retorna uma mensagem de erro caso a tabela esteja vazia
        return response()->json(['message' => 'Nenhuma ordem encontrada'], 404);
    }
}



    
}
