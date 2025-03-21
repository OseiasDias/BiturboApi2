<?php

namespace App\Http\Controllers;

use App\Models\Marca; // Certifique-se de importar o modelo correto
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    // Retorna todas as marcas cadastradas
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    // Cadastra uma nova marca
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome',
        ]);

        $marca = Marca::create([
            'nome' => $request->nome,
        ]);

        return response()->json(['message' => 'Marca cadastrada com sucesso!', 'marca' => $marca], 201);
    }

    // Retorna uma marca específica
    public function show($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        return response()->json($marca);
    }

    // Atualiza os dados de uma marca
    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        $request->validate([
            'nome' => 'required|string|max:255|unique:marcas,nome,' . $id,
        ]);

        $marca->update(['nome' => $request->nome]);

        return response()->json(['message' => 'Marca atualizada com sucesso!', 'marca' => $marca]);
    }

    // Exclui uma marca
    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        $marca->delete();

        return response()->json(['message' => 'Marca excluída com sucesso!']);
    }
}
