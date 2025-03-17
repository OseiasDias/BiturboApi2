<?php

namespace App\Http\Controllers;

use App\Models\Senha;
use Illuminate\Http\Request;

class SenhaController extends Controller
{
    // Criar uma nova senha
    public function store(Request $request)
    {
        // Validação do campo senha
        $request->validate([
            'password' => 'required|string|min:6',  // Senha deve ser string com no mínimo 6 caracteres
        ]);

        // Criando uma nova senha sem criptografia
        $senha = Senha::create([
            'password' => $request->password, // Armazena a senha como string normal
        ]);

        return response()->json([
            'message' => 'Senha criada com sucesso!',
            'senha' => $senha,
        ]);
    }

    // Exibir a lista de senhas (Read)
    public function index()
    {
        $senhas = Senha::all();

        return response()->json([
            'senhas' => $senhas,
        ]);
    }

    // Exibir uma senha específica (Read)
    public function show($id)
    {
        $senha = Senha::findOrFail($id);

        return response()->json([
            'senha' => $senha,
        ]);
    }

    // Atualizar uma senha existente (Update)
    public function update(Request $request, $id)
    {
        // Validação do campo senha
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        // Encontrando a senha pelo ID
        $senha = Senha::findOrFail($id);

        // Atualizando a senha sem criptografia
        $senha->update([
            'password' => $request->password, // Armazena a senha como string normal
        ]);

        return response()->json([
            'message' => 'Senha atualizada com sucesso!',
            'senha' => $senha,
        ]);
    }

    // Deletar uma senha (Delete)
    public function destroy($id)
    {
        $senha = Senha::findOrFail($id);
        $senha->delete();

        return response()->json([
            'message' => 'Senha excluída com sucesso!',
        ]);
    }

    // Verificar a senha (agora sem criptografia)
    public function verifyPassword(Request $request, $id)
    {
        // Validação do campo senha
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        try {
            $senha = Senha::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar senha no banco de dados.'], 500);
        }

        // Comparação direta da senha sem hash
        if ($request->password === $senha->password) {
            return response()->json([
                'message' => 'Senha verificada com sucesso!',
            ]);
        } else {
            return response()->json([
                'message' => 'Senha inválida!',
            ], 400);
        }
    }
}
