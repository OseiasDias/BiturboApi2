<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class AdministradorController extends Controller
{
    // Listar todos os administradores
    public function index()
    {
        $administradores = Administrador::all();
        return response()->json($administradores);
    }

    // Criar um novo administrador
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'email' => 'required|email|unique:administradores,email',
            'password' => 'required|string|min:8', // 🔄 Alterado de 'senha' para 'password'
            'foto' => 'nullable|string',
            'genero' => 'required|in:masculino,feminino',
            'celular' => 'required|string|max:255|unique:administradores,celular',
            'telefone_fixo' => 'nullable|string|max:255',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'nome_exibicao' => 'nullable|string|max:255',
            'data_admissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'endereco' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Criar o administrador com a senha hash
        $administrador = Administrador::create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'data_nascimento' => $request->data_nascimento,
            'email' => $request->email,
            'foto' => $request->foto,
            'genero' => $request->genero,
            'password' => Hash::make($request->password), // 🔒 Hash na senha
            'celular' => $request->celular,
            'telefone_fixo' => $request->telefone_fixo,
            'filial' => $request->filial,
            'cargo' => $request->cargo,
            'nome_exibicao' => $request->nome_exibicao,
            'data_admissao' => $request->data_admissao,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'endereco' => $request->endereco,
            'remember_token' => null,
        ]);

        return response()->json($administrador, 201);
    }

    // Detalhes de um administrador
    public function show($id)
    {
        $administrador = Administrador::findOrFail($id);
        return response()->json($administrador);
    }

    // Atualizar um administrador
    public function update(Request $request, $id)
    {
        $administrador = Administrador::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'sometimes|string|max:255',
            'sobrenome' => 'sometimes|string|max:255',
            'data_nascimento' => 'nullable|date',
            'email' => 'sometimes|email|unique:administradores,email,' . $id,
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|string',
            'genero' => 'sometimes|in:masculino,feminino',
            'celular' => 'sometimes|string|max:255|unique:administradores,celular,' . $id,
            'telefone_fixo' => 'nullable|string|max:255',
            'filial' => 'sometimes|string|max:255',
            'cargo' => 'sometimes|string|max:255',
            'nome_exibicao' => 'nullable|string|max:255',
            'data_admissao' => 'sometimes|date',
            'pais' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|max:255',
            'cidade' => 'sometimes|string|max:255',
            'endereco' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Atualizar os dados
        $administrador->fill($request->except('password'));

        // Se o campo 'password' foi enviado, aplicar hash antes de salvar
        if ($request->has('password')) {
            $administrador->password = Hash::make($request->password);
        }

        $administrador->save();

        return response()->json($administrador);
    }

    // Deletar um administrador
    public function destroy($id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->delete();
        return response()->json(['message' => 'Administrador deletado com sucesso.']);
    }

    public function buscarAdministradorPorCredenciais(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Campos inválidos'], 400);
        }
    
        // Buscar o administrador pelo email
        $administrador = Administrador::where('email', $request->email)->first();
    
        // Comparação direta da senha sem Hash
        if (!$administrador || $request->password !== $administrador->password) {
            return response()->json(['message' => 'Administrador não encontrado ou senha incorreta'], 404);
        }
    
        return response()->json([
            'message' => 'Administrador encontrado',
            'administrador' => $administrador
        ], 200);
    }
    
    


  
}
