<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Exibir lista de compras
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
    }

    // Criar nova compra
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'numero_compra' => 'required|unique:compras',
            'data_compra' => 'required|date',
            'fornecedor' => 'required|exists:fornecedores,id',
            'celular' => 'required|string',
            'email' => 'required|email',
            'endereco' => 'required|string',
            'galho' => 'required|string'
        ]);

        // Criação da nova compra
        $compra = Compra::create([
            'numero_compra' => $request->numero_compra,
            'data_compra' => $request->data_compra,
            'fornecedor_id' => $request->fornecedor,
            'celular' => $request->celular,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'galho' => $request->galho,
        ]);

        // Retorna a compra criada com status 201 (criado)
        return response()->json($compra, 201);
    }

    // Exibir compra específica
    public function show($id)
    {
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        return response()->json($compra);
    }

    // Atualizar dados da compra
    public function update(Request $request, $id)
    {
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        // Atualiza os dados da compra
        $compra->update($request->all());

        return response()->json($compra);
    }

    // Deletar compra
    public function destroy($id)
    {
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        $compra->delete();

        return response()->json(['message' => 'Compra deletada com sucesso']);
    }
}
