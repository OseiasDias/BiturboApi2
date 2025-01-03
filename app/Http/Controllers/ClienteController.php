<?php


namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    // Exibe todos os clientes
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    // Exibe um cliente específico
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }

    // Cria um novo cliente
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:50',
            'data_nascimento' => 'nullable|date',
            'email' => 'required|email|unique:clientes,email',
            'foto' => 'nullable|string|url',
            'genero' => 'required|in:masculino,feminino',
            'senha' => 'required|string|min:8',
            'celular' => 'required|string|unique:clientes,celular',
            'nome_exibicao' => 'nullable|string|max:255',
            'nome_empresa' => 'nullable|string|max:255',
            'telefone_fixo' => 'nullable|string',
            'nif' => 'nullable|string|max:255',
            'id_pais' => 'required|integer',
            'id_provincia' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'endereco' => 'required|string|max:500',
            'estado' => 'nullable|integer',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verifica se o campo 'foto' foi enviado e faz o upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('clientes', 's3');
            $fotoUrl = Storage::disk('s3')->url($path);
            $request->merge(['foto' => $fotoUrl]);
        }

        // Cria o cliente
        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

    // Atualiza as informações de um cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:50',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'foto' => 'nullable|string|url',
            'genero' => 'required|in:masculino,feminino',
            'celular' => 'required|string|unique:clientes,celular,' . $id,
            'nome_exibicao' => 'nullable|string|max:255',
            'nome_empresa' => 'nullable|string|max:255',
            'telefone_fixo' => 'nullable|string',
            'nif' => 'nullable|string|max:255',
            'id_pais' => 'required|integer',
            'id_provincia' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'endereco' => 'required|string|max:500',
            'estado' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cliente->update($request->all());
        return response()->json($cliente);
    }

    // Deleta um cliente
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->delete();
        return response()->json(['message' => 'Cliente excluído com sucesso']);
    }
}
