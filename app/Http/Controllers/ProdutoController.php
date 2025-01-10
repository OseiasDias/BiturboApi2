<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    // Exibe todos os produtos
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    // Exibe um produto específico
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    // Cria um novo produto
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'numero_produto' => 'required|string|max:255|unique:produtos',
            'data_compra' => 'required|date',
            'nome' => 'required|string|max:255',
            'galho' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string|max:50',
            'fornecedor' => 'required|string|max:255',
            'cor' => 'nullable|string|max:50',
            'garantia' => 'nullable|string|max:255',
            'imagem' => 'nullable|string|max:255', // Se você deseja armazenar o nome do arquivo da imagem
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cria o produto
        $produto = Produto::create($request->all());
        return response()->json($produto, 201);
    }

    // Atualiza as informações de um produto
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'numero_produto' => 'required|string|max:255|unique:produtos,numero_produto,' . $id,
            'data_compra' => 'required|date',
            'nome' => 'required|string|max:255',
            'galho' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string|max:50',
            'fornecedor' => 'required|string|max:255',
            'cor' => 'nullable|string|max:50',
            'garantia' => 'nullable|string|max:255',
            'imagem' => 'nullable|string|max:255', // Se você deseja armazenar o nome do arquivo da imagem
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $produto->update($request->all());
        return response()->json($produto);
    }

    // Deleta um produto
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $produto->delete();
        return response()->json(['message' => 'Produto excluído com sucesso']);
    }
}
