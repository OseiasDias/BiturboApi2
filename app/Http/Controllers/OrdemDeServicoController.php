<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Exibe uma lista de todos os produtos.
     */
    public function index()
    {
        $produtos = Produto::all(); // Recupera todos os produtos
        return response()->json($produtos); // Retorna a lista de produtos em formato JSON
    }

    /**
     * Exibe os detalhes de um produto específico.
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto); // Retorna os detalhes do produto
    }

    /**
     * Cria um novo produto.
     */
    public function store(Request $request)
    {
        // Validação dos dados do produto
        $validator = Validator::make($request->all(), [
            'data_compra' => 'required|date',
            'nome' => 'required|max:100',
            'galho' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string|max:255',
            'fornecedor' => 'required|string|max:255',
            'garantia' => 'nullable|max:100',
            'imagem' => 'nullable|string|max:255',
            'nota' => 'nullable|max:100',
            'nota_arquivos' => 'nullable|string',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
        ]);

        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Criação do produto
        $produto = Produto::create([
            'data_compra' => $request->data_compra,
            'nome' => $request->nome,
            'galho' => $request->galho,
            'fabricante' => $request->fabricante,
            'preco' => $request->preco,
            'unidade_medida' => $request->unidade_medida,
            'fornecedor' => $request->fornecedor,
            'garantia' => $request->garantia ?? null,
            'imagem' => $request->imagem ?? null,
            'nota' => $request->nota ?? null,
            'nota_arquivos' => $request->nota_arquivos ?? null,
            'interna' => $request->interna ?? false,
            'compartilhada' => $request->compartilhada ?? false,
        ]);

        return response()->json($produto, 201); // Retorna o produto criado
    }

    /**
     * Atualiza um produto existente.
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        // Validação dos dados do produto
        $validator = Validator::make($request->all(), [
            'data_compra' => 'required|date',
            'nome' => 'required|max:100',
            'galho' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string|max:255',
            'fornecedor' => 'required|string|max:255',
            'garantia' => 'nullable|max:100',
            'imagem' => 'nullable|string|max:255',
            'nota' => 'nullable|max:100',
            'nota_arquivos' => 'nullable|string',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
        ]);

        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Atualiza o produto
        $produto->update([
            'data_compra' => $request->data_compra,
            'nome' => $request->nome,
            'galho' => $request->galho,
            'fabricante' => $request->fabricante,
            'preco' => $request->preco,
            'unidade_medida' => $request->unidade_medida,
            'fornecedor' => $request->fornecedor,
            'garantia' => $request->garantia ?? null,
            'imagem' => $request->imagem ?? null,
            'nota' => $request->nota ?? null,
            'nota_arquivos' => $request->nota_arquivos ?? null,
            'interna' => $request->interna ?? false,
            'compartilhada' => $request->compartilhada ?? false,
        ]);

        return response()->json($produto); // Retorna o produto atualizado
    }

    /**
     * Remove um produto.
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        // Deleta o produto
        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso']); // Retorna mensagem de sucesso
    }
}
