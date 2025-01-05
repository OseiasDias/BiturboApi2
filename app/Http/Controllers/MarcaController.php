<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    public function index()
    {
        return Marca::with('tipoVeiculo')->get(); // Retorna todas as marcas com seus tipos de veículos
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|unique:marcas,nome',
            'tipo_veiculo_id' => 'required|exists:tipo_veiculos,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Criação da nova marca
        $marca = Marca::create($request->all());

        return response()->json($marca, 201);
    }

    public function show($id)
    {
        $marca = Marca::with('tipoVeiculo')->find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        return response()->json($marca);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|unique:marcas,nome,' . $marca->id,
            'tipo_veiculo_id' => 'required|exists:tipo_veiculos,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Atualiza a marca
        $marca->update($request->all());

        return response()->json($marca);
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json(['message' => 'Marca não encontrada'], 404);
        }

        $marca->delete();

        return response()->json(null, 204);
    }
}
