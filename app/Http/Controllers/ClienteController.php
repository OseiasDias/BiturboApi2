<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\OrdemDeServico;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:50',
            'numero_cliente' => 'required|string|unique:clientes,numero_cliente',
            'celular' => 'required|string|unique:clientes,celular',
            'email' => 'required|email|unique:clientes,email',
            'password' => 'required|string|min:8',
            'genero' => 'required|in:masculino,feminino',
            'pais' => 'required|string',
            'provincia' => 'nullable|string',
            'municipio' => 'nullable|string',
            'endereco' => 'required|string',
            'nota' => 'nullable|string',
            'bloqueado' => 'boolean',
            'arquivo_nota' => 'nullable|file|max:2048',
            'interna' => 'nullable|boolean',
            'compartilhado' => 'nullable|boolean',
            'foto' => 'nullable|file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('clientes', 's3');
            $request->merge(['foto' => Storage::disk('s3')->url($path)]);
        }

        if ($request->hasFile('arquivo_nota')) {
            $filePath = $request->file('arquivo_nota')->store('notas', 's3');
            $request->merge(['arquivo_nota' => Storage::disk('s3')->url($filePath)]);
        }

        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->password = Hash::make($request->password);
        $cliente->save();

        return response()->json($cliente, 201);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'celular' => 'nullable|string|unique:clientes,celular,' . $cliente->id,
            'email' => 'nullable|email|unique:clientes,email,' . $cliente->id,
            'numero_cliente' => 'required|string',
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|file|image|max:2048',
            'arquivo_nota' => 'nullable|file|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('s3')->delete($cliente->foto);
            }
            $path = $request->file('foto')->store('clientes', 's3');
            $request->merge(['foto' => Storage::disk('s3')->url($path)]);
        }

        if ($request->hasFile('arquivo_nota')) {
            if ($cliente->arquivo_nota) {
                Storage::disk('s3')->delete($cliente->arquivo_nota);
            }
            $filePath = $request->file('arquivo_nota')->store('notas', 's3');
            $request->merge(['arquivo_nota' => Storage::disk('s3')->url($filePath)]);
        }

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $cliente->update($request->all());
        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        // Excluir arquivos do S3 antes de deletar o cliente
        if ($cliente->foto) {
            Storage::disk('s3')->delete($cliente->foto);
        }
        if ($cliente->arquivo_nota) {
            Storage::disk('s3')->delete($cliente->arquivo_nota);
        }

        // Excluir registros relacionados
        Factura::where('cliente_id', $id)->delete();
        OrdemDeServico::where('cust_id', $id)->delete();

        $cliente->delete();

        return response()->json(['message' => 'Cliente excluído com sucesso']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $cliente = Auth::user();
            return response()->json($cliente);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }

    public function getLastId()
    {
        $ultimoCliente = Cliente::latest('id')->first();
        $ultimoId = $ultimoCliente ? $ultimoCliente->id + 1 : 1;
        return response()->json(['ultimo_id' => $ultimoId]);
    }

    public function toggleBloqueio($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->bloqueado = !$cliente->bloqueado;
        $cliente->save();

        return response()->json($cliente);
    }
}
