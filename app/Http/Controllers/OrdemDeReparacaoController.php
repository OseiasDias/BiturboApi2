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
            'horas_reparacao' => 'nullable|integer'
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

     

   

    public function getLastId()
    {
        // Obtém o último registro baseado no campo 'id'
        $ultimaOrdem = OrdemDeReparacao::latest('id')->first();
    
        // Se houver um registro, incrementa o ID em 1, caso contrário, começa com o número 1
        $ultimoId = $ultimaOrdem ? $ultimaOrdem->id + 1 : 1;
    
        return response()->json(['ultimo_id' => $ultimoId]);
    }
    


    // Nova função para buscar uma ordem pelo numero_trabalho
    public function showByNumeroTrabalho($numero_trabalho)
    {
        // Buscando a ordem pelo numero_trabalho
        $ordem = OrdemDeReparacao::where('numero_trabalho', $numero_trabalho)->first();

        // Verificando se a ordem foi encontrada
        if (!$ordem) {
            return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
        }

        return response()->json($ordem);
    }


      // Novo método para retornar apenas o id pela 'numero_trabalho'
      public function passaonumero_trabalho($numero_trabalho)
      {
          // Buscando a ordem pelo numero_trabalho
          $ordem = OrdemDeReparacao::where('numero_trabalho', $numero_trabalho)->first();
  
          // Verificando se a ordem foi encontrada
          if (!$ordem) {
              return response()->json(['message' => 'Ordem de reparação não encontrada'], 404);
          }
  
          // Retornando apenas o id
          return response()->json(['id' => $ordem->id]);
      }

    
}
