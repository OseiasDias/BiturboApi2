<?php

namespace App\Http\Controllers;

use App\Models\EquipeSuporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Importando a facade Auth

class EquipeSuporteController extends Controller
{
    /**
     * Exibir todos os registros de equipe de suporte.
     */
    public function index()
    {
        $equipe = EquipeSuporte::all();
        return response()->json($equipe);
    }

    /**
     * Exibir um único registro de equipe de suporte.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar a equipe por ID
        $equipe = EquipeSuporte::find($id);

        // Verificar se a equipe foi encontrada
        if (!$equipe) {
            return response()->json(['message' => 'Equipe não encontrada'], 404);
        }

        return response()->json($equipe);
    }

    /**
     * Criar um novo registro de equipe de suporte.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'email' => 'required|email|unique:equipe_suporte,email',
            'foto' => 'nullable|image',
            'genero' => 'required|in:masculino,feminino',
            'senha' => 'required|string|min:8',
            'celular' => 'required|string|unique:equipe_suporte,celular',
            'telefone_fixo' => 'nullable|string',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'nome_exibicao' => 'nullable|string|max:255',
            'data_admissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'endereco' => 'required|string|max:500',
        ]);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Criar o novo registro
        $equipe = new EquipeSuporte();
        $equipe->fill($request->all());

        // Criptografar a senha antes de salvar
        $equipe->senha = Hash::make($request->senha);
        $equipe->save();

        // Retornar a resposta com o novo registro criado
        return response()->json($equipe, 201);
    }

    /**
     * Atualizar um registro de equipe de suporte.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscar a equipe pelo ID
        $equipe = EquipeSuporte::find($id);
    
        // Verificar se a equipe foi encontrada
        if (!$equipe) {
            return response()->json(['message' => 'Equipe não encontrada'], 404);
        }
    
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'nullable|string|max:255',
            'sobrenome' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|unique:equipe_suporte,email,' . $id,
            'foto' => 'nullable|string|url',
            'genero' => 'nullable|in:masculino,feminino',
            'senha' => 'nullable|string|min:8',
            'celular' => 'nullable|string|unique:equipe_suporte,celular,' . $id,
            'telefone_fixo' => 'nullable|string',
            'filial' => 'nullable|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'nome_exibicao' => 'nullable|string|max:255',
            'data_admissao' => 'nullable|date',
            'pais' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:500',
        ]);
    
        // Verificar se a validação falhou
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Atualizar os dados
        $equipe->fill($request->all());
    
        // Se a senha foi fornecida, criptografá-la
        if ($request->has('senha')) {
            $equipe->senha = Hash::make($request->senha);
        }
    
        // Se o genero foi passado como 0 ou 1, converter para 'masculino' ou 'feminino'
        if (isset($request->genero)) {
            $equipe->genero = $request->genero == '0' ? 'masculino' : 'feminino';
        }
    
        $equipe->save();
    
        // Retornar o registro atualizado
        return response()->json($equipe);
    }
    
    /**
     * Excluir um registro de equipe de suporte.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar a equipe pelo ID
        $equipe = EquipeSuporte::find($id);

        // Verificar se a equipe foi encontrada
        if (!$equipe) {
            return response()->json(['message' => 'Equipe não encontrada'], 404);
        }

        // Deletar o registro
        $equipe->delete();

        // Retornar uma mensagem de sucesso
        return response()->json(['message' => 'Equipe excluída com sucesso']);
    }


     /**
     * Fazer o login do usuário da equipe de suporte.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validar os dados recebidos
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tentar autenticar o usuário com as credenciais fornecidas
        $user = EquipeSuporte::where('email', $request->email)->first();

        // Verificar se o usuário foi encontrado e a senha está correta
        if ($user && Hash::check($request->senha, $user->senha)) {
            // Autenticação bem-sucedida
            return response()->json([
                'message' => 'Login realizado com sucesso.',
                'user' => $user,
                'token' => $user->createToken('token_de_acesso')->plainTextToken, // Se estiver usando Laravel Sanctum ou Passport
            ], 200);
        } else {
            // Se não encontrar o usuário ou a senha estiver incorreta
            return response()->json([
                'message' => 'Credenciais inválidas. Tente novamente.',
            ], 401);
        }
    }
}
