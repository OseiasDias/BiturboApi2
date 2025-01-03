<?php

// app/Http/Controllers/FuncionarioController.php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return response()->json($funcionarios);
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
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:50',
            'data_nascimento' => 'nullable|date',
            'email' => 'required|email|unique:funcionarios,email',
            'foto' => 'nullable|string|url', // Validando o campo foto como uma URL
            'genero' => 'required|in:masculino,feminino',
            'senha' => 'required|string|min:8',
            'celular' => 'required|string|unique:funcionarios,celular',
            'telefone_fixo' => 'nullable|string',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'nome_exibicao' => 'nullable|string|max:255',
            'data_admissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'endereco' => 'required|string|max:500',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Verifica se o campo 'foto' foi enviado e é um arquivo
        if ($request->hasFile('foto')) {
            // Faz o upload da imagem para o Amazon S3 e recupera o caminho da URL
            $foto = $request->file('foto');
            $path = $foto->store('funcionarios', 's3'); // O segundo parâmetro é o disco configurado no S3
            $fotoUrl = Storage::disk('s3')->url($path); // Gera a URL pública do arquivo
    
            // Agora podemos armazenar a URL da imagem no banco de dados
            $request->merge(['foto' => $fotoUrl]);
        }
    
        // Cria o novo funcionário
        $funcionario = new Funcionario();
        $funcionario->fill($request->all());
        $funcionario->senha = Hash::make($request->senha); // Criptografa a senha
        $funcionario->save();
    
        return response()->json($funcionario, 201);
    }
    

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
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
}
