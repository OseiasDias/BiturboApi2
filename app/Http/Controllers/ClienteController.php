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
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:50',
            'numero_cliente' => 'required|string|unique:clientes,numero_cliente', // Aqui garantimos que o 'numero_cliente' seja único
            'celular' => 'required|string|unique:clientes,celular', // 'celular' deve ser único na tabela
            'email' => 'required|email|unique:clientes,email', // 'email' deve ser único na tabela
            'senha' => 'required|string|min:8',
            'genero' => 'required|in:masculino,feminino',
            'pais' => 'required|string',
            'endereco' => 'required|string',
            'arquivo_nota' => 'nullable|string',
            'interna' => 'nullable|boolean',
            'compartilhado' => 'nullable|boolean',
            'foto' => 'nullable|string',
        ]);
        

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Lógica para o upload da foto
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('clientes', 's3');
            $fotoUrl = Storage::disk('s3')->url($path);
            $request->merge(['foto' => $fotoUrl]);
        }

        // Lógica para o upload do arquivo
        if ($request->hasFile('arquivo_nota')) {
            $filePath = $request->file('arquivo_nota')->store('notas', 's3');
            $arquivoNotaUrl = Storage::disk('s3')->url($filePath);
            $request->merge(['arquivo_nota' => $arquivoNotaUrl]);
        }

        // Criação do cliente
        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->senha = Hash::make($request->senha);
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
            'senha' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('senha')) {
            $request->merge(['senha' => Hash::make($request->senha)]);
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

    // Deletar os registros relacionados manualmente
    Factura::where('cliente_id', $id)->delete(); // Exclui faturas do cliente
    OrdemDeServico::where('cust_id ', $id)->delete(); // Exclui ordens de serviço do cliente

    // Agora, excluir o cliente
    $cliente->delete();

    return response()->json(['message' => 'Cliente excluído com sucesso']);
}
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            $cliente = Auth::user();
            return response()->json($cliente);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }

    public function getLastId()
{
    // Obtém o último cliente baseado no campo 'id'
    $ultimoCliente = Cliente::latest('id')->first();
    
    // Se houver um cliente, incrementa o ID em 1, caso contrário, começa com o número 1
    $ultimoId = $ultimoCliente ? $ultimoCliente->id + 1 : 1;

    // Retorna o próximo ID
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




