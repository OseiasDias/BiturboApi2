<?php



namespace App\Http\Controllers;

use App\Models\Senha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SenhaController extends Controller
{
    // Criar uma nova senha
    public function store(Request $request)
    {
        // Validação do campo senha
        $request->validate([
            'senha' => 'required|string|min:6',  // Valida que a senha seja uma string com no mínimo 6 caracteres
        ]);

        // Criação de uma nova senha
        $senha = Senha::create([
            'senha' => Hash::make($request->senha),  // Criptografando a senha
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
            'senha' => 'required|string|min:6',  // Valida que a senha seja uma string com no mínimo 6 caracteres
        ]);

        // Encontrando a senha pelo ID
        $senha = Senha::findOrFail($id);

        // Atualizando a senha
        $senha->update([
            'senha' => Hash::make($request->senha),  // Criptografando a nova senha
        ]);

        return response()->json([
            'message' => 'Senha atualizada com sucesso!',
            'senha' => $senha,
        ]);
    }

    // Deletar uma senha (Delete)
    public function destroy($id)
    {
        // Encontrando a senha pelo ID
        $senha = Senha::findOrFail($id);

        // Deletando a senha
        $senha->delete();

        return response()->json([
            'message' => 'Senha excluída com sucesso!',
        ]);
    }

    // Função para verificar a senha
    public function verifyPassword(Request $request, $id)
    {
        // Logando os dados da requisição para verificar o que está sendo enviado
        \Log::info('Dados recebidos para verificação: ', ['senha_recebida' => $request->senha]);
    
        // Validação do campo senha
        $request->validate([
            'senha' => 'required|string|min:6',  // Valida que a senha seja uma string com no mínimo 6 caracteres
        ]);
    
        // Verificar se a senha foi validada corretamente
        \Log::info('Senha após validação: ', ['senha' => $request->senha]);
    
        // Encontrando a senha pelo ID
        try {
            $senha = Senha::findOrFail($id); // Caso não encontre, vai lançar uma exceção
        } catch (\Exception $e) {
            \Log::error('Erro ao encontrar a senha no banco de dados: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao buscar senha no banco de dados.'], 500);
        }
    
        // Logando a senha armazenada no banco (apenas para debug)
        \Log::info('Senha armazenada no banco: ', ['senha_banco' => $senha->senha]);
    
        // Verificando se a senha fornecida corresponde à senha criptografada
        if (Hash::check($request->senha, $senha->senha)) {
            return response()->json([
                'message' => 'Senha verificada com sucesso!',
            ]);
        } else {
            \Log::warning('Senha incorreta fornecida para o ID: ' . $id);
            return response()->json([
                'message' => 'Senha inválida!',
            ], 400);
        }
    }
    
    
}
