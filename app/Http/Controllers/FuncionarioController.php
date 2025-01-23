<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return response()->json($funcionarios);
    }

     /**
     * Método para login do funcionário
     */
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verificando as credenciais
        $funcionario = Funcionario::where('email', $request->email)->first();
        
        if (!$funcionario || !Hash::check($request->senha, $funcionario->senha)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Gerar o token de autenticação (usando Laravel Passport ou outra implementação)
        $token = $funcionario->createToken('FuncionarioApp')->accessToken;

        // Retornar os dados do funcionário e o token
        return response()->json([
            'funcionario' => $funcionario,
            'token' => $token,
        ]);
    }


    public function show($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }
        return response()->json($funcionario);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'email' => 'required|email|unique:funcionarios,email',
            'bilheteIdentidade' => 'required|string|max:255',
            'senha' => 'required|string|min:8',
            'nomeBanco' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'genero' => 'required|in:masculino,feminino',
            'celular' => 'required|string|max:20',
            'telefoneFixo' => 'nullable|string|max:20',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'nomeExibicao' => 'nullable|string|max:255',
            'dataAdmissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'estado' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'endereco' => 'required|string',
            'bloqueado' => 'nullable|boolean',
        ]);

        $funcionario = Funcionario::create($validated);

        return response()->json($funcionario, 201);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'celular' => 'nullable|string|unique:funcionarios,celular,' . $funcionario->id,
            'email' => 'nullable|email|unique:funcionarios,email,' . $funcionario->id,
            'senha' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('senha')) {
            $request->merge(['senha' => Hash::make($request->senha)]);
        }

        $funcionario->update($request->all());
        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $funcionario->delete();
        return response()->json(['message' => 'Funcionário excluído com sucesso']);
    }

    public function toggleBloqueio($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $funcionario->bloqueado = !$funcionario->bloqueado;
        $funcionario->save();

        return response()->json($funcionario);
    }
}
