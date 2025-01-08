<?php

// app/Http/Controllers/FabricanteController.php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    // Listar todos os fabricantes
    public function index()
    {
        $fabricantes = Fabricante::all(); // Obtém todos os fabricantes
        return response()->json($fabricantes);
    }

    // Criar um novo fabricante
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:100', // Valida que o nome é obrigatório e não ultrapassa 30 caracteres
        ]);

        // Criação do novo fabricante
        $fabricante = Fabricante::create([
            'nome' => $request->nome,
        ]);

        return response()->json($fabricante, 201); // Retorna o fabricante criado
    }

    // Exibir um fabricante específico
    public function show($id)
    {
        // Encontrar o fabricante pelo ID
        $fabricante = Fabricante::findOrFail($id); // Lança exceção se não encontrar
        return response()->json($fabricante);
    }

    // Atualizar um fabricante
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:100', // Valida que o nome é obrigatório e não ultrapassa 30 caracteres
        ]);

        // Encontrar o fabricante pelo ID
        $fabricante = Fabricante::findOrFail($id); // Lança exceção se não encontrar

        // Atualizar o nome do fabricante
        $fabricante->nome = $request->nome;
        $fabricante->save(); // Salva as alterações

        return response()->json($fabricante); // Retorna o fabricante atualizado
    }

    // Remover um fabricante
    public function destroy($id)
    {
        // Encontrar o fabricante pelo ID
        $fabricante = Fabricante::findOrFail($id); // Lança exceção se não encontrar
        $fabricante->delete(); // Deleta o fabricante

        return response()->json(['message' => 'Fabricante removido com sucesso!'], 204); // Retorna uma mensagem de sucesso
    }
}
