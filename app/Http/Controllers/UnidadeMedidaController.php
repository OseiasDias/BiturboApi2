<?php

namespace App\Http\Controllers;

use App\Models\UnidadeMedida;
use Illuminate\Http\Request;

class UnidadeMedidaController extends Controller
{
    // Método para listar todas as unidades de medida
    public function index()
    {
        $unidades = UnidadeMedida::all();
        return response()->json($unidades);
    }

    // Método para armazenar uma nova unidade de medida
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'unidade' => 'required|string|max:100|unique:unidade_medidas', // Tamanho máximo de 100 e campo único
        ]);

        // Criação da unidade de medida
        $unidadeMedida = UnidadeMedida::create($request->all());

        // Retornar a unidade de medida criada
        return response()->json($unidadeMedida, 201);
    }

    // Método para exibir uma unidade de medida específica
    public function show($id)
    {
        $unidade = UnidadeMedida::findOrFail($id);
        return response()->json($unidade);
    }

    // Método para atualizar uma unidade de medida existente
    public function update(Request $request, $id)
    {
        $unidade = UnidadeMedida::findOrFail($id);

        // Validação
        $request->validate([
            'unidade' => 'required|string|max:100|unique:unidade_medidas,unidade,' . $unidade->id, // Atualiza com exceção para o registro atual
        ]);

        // Atualização da unidade de medida
        $unidade->update($request->all());

        return response()->json($unidade);
    }

    // Método para excluir uma unidade de medida
    public function destroy($id)
    {
        UnidadeMedida::destroy($id);
        return response()->json(null, 204);
    }
}
