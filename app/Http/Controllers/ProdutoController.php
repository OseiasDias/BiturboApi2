<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Exibir lista de produtos
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    // Criar novo produto
    public function store(Request $request)
    {
        $request->validate([
            'numero_produto' => 'required|unique:produtos',
            'data_compra' => 'required|date',
            'nome' => 'required|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required',
            'fornecedor' => 'required',
        ]);

        $produto = Produto::create($request->all());

        return response()->json($produto, 201);
    }

    // Exibir produto específico
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    // Atualizar produto
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $produto->update($request->all());

        return response()->json($produto);
    }

    // Deletar produto
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
