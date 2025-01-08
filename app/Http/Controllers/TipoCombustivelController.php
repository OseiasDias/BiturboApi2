<?php

// app/Http/Controllers/TipoCombustivelController.php

namespace App\Http\Controllers;

use App\Models\TipoCombustivel;
use Illuminate\Http\Request;

class TipoCombustivelController extends Controller
{
    // Listar todos os tipos de combustíveis
    public function index()
    {
        $combustiveis = TipoCombustivel::all(); // Obtém todos os tipos de combustíveis
        return response()->json($combustiveis); // Retorna os combustíveis como JSON
    }

    // Criar um novo tipo de combustível
    public function store(Request $request)
    {
        // Validação do nome
        $request->validate([
            'nome' => 'required|string|max:255', // O nome é obrigatório e não pode exceder 255 caracteres
        ]);

        // Criação do novo tipo de combustível
        $combustivel = TipoCombustivel::create([
            'nome' => $request->nome,
        ]);

        return response()->json($combustivel, 201); // Retorna o combustível criado
    }

    // Deletar um tipo de combustível
    public function destroy($id)
    {
        // Encontrar o combustível pelo ID
        $combustivel = TipoCombustivel::findOrFail($id);

        // Deletar o combustível
        $combustivel->delete();

        return response()->json(['message' => 'Tipo de combustível removido com sucesso!'], 204); // Retorna uma mensagem de sucesso
    }
}
