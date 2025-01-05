<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CorController extends Controller
{
    public function index()
    {
        return Cor::all(); // Retorna todas as cores cadastradas
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|unique:cors,nome',
            'codigo_hex' => 'nullable|string|max:7', // Ex: #FFFFFF
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Criação da nova cor
        $cor = Cor::create($request->all());

        return response()->json($cor, 201);
    }

    public function show($id)
    {
        $cor = Cor::find($id);

        if (!$cor) {
            return response()->json(['message' => 'Cor não encontrada'], 404);
        }

        return response()->json($cor);
    }

    public function update(Request $request, $id)
    {
        $cor = Cor::find($id);

        if (!$cor) {
            return response()->json(['message' => 'Cor não encontrada'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|unique:cors,nome,' . $cor->id,
            'codigo_hex' => 'nullable|string|max:7',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Atualiza a cor
        $cor->update($request->all());

        return response()->json($cor);
    }

    public function destroy($id)
    {
        $cor = Cor::find($id);

        if (!$cor) {
            return response()->json(['message' => 'Cor não encontrada'], 404);
        }

        $cor->delete();

        return response()->json(null, 204);
    }
}
