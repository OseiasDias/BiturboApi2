<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    // Método para listar todos os funcionários
    public function index()
    {
        $funcionarios = Funcionario::all();
        return response()->json($funcionarios);
    }

    // Método para mostrar um único funcionário
    public function show($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionario não encontrado'], 404);
        }
        return response()->json($funcionario);
    }

    // Método para criar um novo funcionário
    public function store(Request $request)
    {
        // Validação com campos adicionais
        $validatedData = $request->validate([
            'numero_funcionario' => 'required|string',
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'email' => 'required|email|unique:funcionarios,email',
            'bilheteIdentidade' => 'required|string',
            'nomeBanco' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'genero' => 'required|in:masculino,feminino',
            'celular' => 'required|string',
            'telefoneFixo' => 'nullable|string|max:255',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'dataAdmissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'estado' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'endereco' => 'required|string',
            'bloqueado' => 'nullable|boolean',
        ]);
    
        // Criação do novo funcionário
        $funcionario = Funcionario::create($validatedData);
    
        return response()->json($funcionario, 201);
    }
    

    // Método para atualizar um funcionário existente
    public function update(Request $request, $id)
    {
        // Encontrar o funcionário
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionario não encontrado'], 404);
        }
    
        // Validação com campos adicionais
        $validatedData = $request->validate([
            'numero_funcionario' => 'required|string',
             // Permitindo atualizar o número do próprio funcionário
            'nome' => 'string|max:255',
            'sobrenome' => 'string|max:255',
            'dataNascimento' => 'date',
            'email' => 'email|unique:funcionarios,email,' . $id,
            'bilheteIdentidade' => 'string',
            'nomeBanco' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'genero' => 'in:masculino,feminino',
            'celular' => 'string',
            'telefoneFixo' => 'nullable|string|max:255',
            'filial' => 'string|max:255',
            'cargo' => 'string|max:255',
            'dataAdmissao' => 'date',
            'pais' => 'string|max:255',
            'estado' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'endereco' => 'string',
            'bloqueado' => 'nullable|boolean',
        ]);
    
        // Atualizando os dados do funcionário
        $funcionario->update($validatedData);
    
        return response()->json($funcionario);
    }
    

    // Método para deletar um funcionário
    public function destroy($id)
    {
        // Encontrar o funcionário
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionario não encontrado'], 404);
        }

        // Deletar o funcionário
        $funcionario->delete();
        return response()->json(['message' => 'Funcionario deletado com sucesso']);
    }

    public function getByNumeroFuncionario($numero_funcionario)
{
    // Buscar funcionário pelo número de funcionário
    $funcionario = Funcionario::where('numero_funcionario', $numero_funcionario)->first();

    // Verificar se o funcionário foi encontrado
    if (!$funcionario) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }

    return response()->json($funcionario);
}

  

public function getLastId()
{
    // Obtém o último registro baseado no campo 'id' da tabela de funcionários
    $ultimoFuncionario = Funcionario::latest('id')->first();

    // Se houver um registro, incrementa o ID em 1, caso contrário, começa com o número 1
    $ultimoId = $ultimoFuncionario ? $ultimoFuncionario->id + 1 : 1;

    return response()->json(['ultimo_id' => $ultimoId]);
}

public function getIdByNumeroFuncionario($numero_funcionario)
{
    // Buscar o funcionário pelo número do funcionário
    $funcionario = Funcionario::where('numero_funcionario', $numero_funcionario)->first();

    // Verificar se o funcionário foi encontrado
    if (!$funcionario) {
        return response()->json(['message' => 'Funcionário não encontrado'], 404);
    }

    // Retornar o id do funcionário encontrado
    return response()->json(['id' => $funcionario->id]);
}





}
