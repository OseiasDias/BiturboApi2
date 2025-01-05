<?php

// app/Http/Controllers/TipoVeiculoController.php

namespace App\Http\Controllers;

use App\Models\TipoVeiculo;
use Illuminate\Http\Request;

class TipoVeiculoController extends Controller
{
    // Método para listar todos os tipos de veículos
    public function index()
    {
        $tipos = TipoVeiculo::all(); // Retorna todos os tipos de veículos
        return response()->json($tipos); // Retorna em formato JSON
    }

    // Método para criar um novo tipo de veículo
    public function store(Request $request)
    {
        // Validação do campo 'tipo' na requisição
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        // Criação do novo tipo de veículo
        $tipoVeiculo = TipoVeiculo::create([
            'tipo' => $request->tipo,
        ]);

        // Retorna o tipo de veículo recém-criado com status 201 (Criado)
        return response()->json($tipoVeiculo, 201);
    }

    // Método para exibir um tipo de veículo específico
    public function show($id)
    {
        // Busca o tipo de veículo pelo ID
        $tipoVeiculo = TipoVeiculo::findOrFail($id); 

        // Retorna o tipo de veículo encontrado
        return response()->json($tipoVeiculo);
    }

    // Método para atualizar um tipo de veículo existente
    public function update(Request $request, $id)
    {
        // Validação do campo 'tipo' na requisição
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        // Busca o tipo de veículo pelo ID
        $tipoVeiculo = TipoVeiculo::findOrFail($id);

        // Atualiza o tipo de veículo
        $tipoVeiculo->tipo = $request->tipo;
        $tipoVeiculo->save(); // Salva as alterações no banco

        // Retorna o tipo de veículo atualizado
        return response()->json($tipoVeiculo);
    }

    // Método para excluir um tipo de veículo
    public function destroy($id)
    {
        // Busca o tipo de veículo pelo ID
        $tipoVeiculo = TipoVeiculo::findOrFail($id);

        // Exclui o tipo de veículo
        $tipoVeiculo->delete();

        // Retorna uma resposta indicando que a exclusão foi bem-sucedida
        return response()->json(['message' => 'Tipo de veículo excluído com sucesso!']);
    }
}
