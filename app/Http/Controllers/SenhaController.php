<?php

namespace App\Http\Controllers;

use App\Models\Senha;
use Illuminate\Http\Request;

class SenhaController extends Controller
{
    // Criar uma nova senha
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $senha = Senha::create([
            'password' => $request->password, // Armazena a senha sem hash
        ]);

        return response()->json([
            'message' => 'Senha criada com sucesso!',
            'senha' => $senha,
        ]);
    }

    // Exibir a lista de senhas
    public function index()
    {
        return response()->json([
            'senhas' => Senha::all(),
        ]);
    }

    // Exibir uma senha específica
    public function show($id)
    {
        return response()->json([
            'senha' => Senha::findOrFail($id),
        ]);
    }

    // Atualizar uma senha existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $senha = Senha::findOrFail($id);
        $senha->update([
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => 'Senha atualizada com sucesso!',
            'senha' => $senha,
        ]);
    }

    // Deletar uma senha
    public function destroy($id)
    {
        $senha = Senha::findOrFail($id);
        $senha->delete();

        return response()->json([
            'message' => 'Senha excluída com sucesso!',
        ]);
    }

    // Verificar a senha
public function verifyPassword(Request $request, $id)
{
    $request->validate([
        'password' => 'required|string|min:6',
    ]);

    try {
        $senha = Senha::where('id', $id)->first();

        if (!$senha) {
            return response()->json([
                'sucesso' => false,
                'message' => 'Registro de senha não encontrado.',
            ], 404);
        }

        if ($request->password === $senha->password) {
            return response()->json([
                'sucesso' => true,
                'message' => 'Senha verificada com sucesso!',
                'id' => $senha->id, // Retorna o ID da senha verificada
            ], 200);
        }

        return response()->json([
            'sucesso' => false,
            'message' => 'Senha inválida!',
        ], 401);

    } catch (\Exception $e) {
        return response()->json([
            'sucesso' => false,
            'message' => 'Erro interno ao processar a solicitação.',
            'erro' => $e->getMessage(),
        ], 500);
    }
}




}