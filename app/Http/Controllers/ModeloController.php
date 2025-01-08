<?php

// app/Http/Controllers/ModeloController.php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    // Listar todos os modelos de veículos
    public function index()
    {
        $modelos = Modelo::all(); // Obtém todos os modelos de veículos
        return response()->json($modelos); // Retorna os modelos como JSON
    }

    // Criar um novo modelo de veículo
    public function store(Request $request)
    {
        // Validação do nome
        $request->validate([
            'nome' => 'required|string|max:255', // O nome é obrigatório e não pode exceder 255 caracteres
        ]);

        // Criação do novo modelo de veículo
        $modelo = Modelo::create([
            'nome' => $request->nome,
        ]);

        return response()->json($modelo, 201); // Retorna o modelo criado
    }

    // Deletar um modelo de veículo
    public function destroy($id)
    {
        // Encontrar o modelo pelo ID
        $modelo = Modelo::findOrFail($id);

        // Deletar o modelo
        $modelo->delete();

        return response()->json(['message' => 'Modelo removido com sucesso!'], 204); // Retorna uma mensagem de sucesso
    }
}
