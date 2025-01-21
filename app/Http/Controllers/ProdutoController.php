<?php


namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fabricante;
use App\Models\Distribuidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'galho' => 'required|string',
            'fabricante_id' => 'required|exists:fabricantes,id',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string',
            'distribuidor_id' => 'required|exists:distribuidors,id',
            'data_compra' => 'required|date',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|string',  // Agora é uma string normal
            'nota' => 'nullable|string|max:100',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $produto = Produto::create([
            'nome' => $request->nome,
            'galho' => $request->galho,
            'fabricante_id' => $request->fabricante_id,
            'preco' => $request->preco,
            'unidade_medida' => $request->unidade_medida,
            'distribuidor_id' => $request->distribuidor_id,
            'data_compra' => $request->data_compra,
            'garantia' => $request->garantia,
            'imagem' => $request->imagem,  // A URL ou caminho da imagem como string
            'nota' => $request->nota,
            'interna' => $request->interna ?? false,
            'compartilhada' => $request->compartilhada ?? false,
        ]);

        return response()->json($produto, 201);
    }

    // Detalhar um produto
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json($produto);
    }

    // Atualizar um produto
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'galho' => 'required|string',
            'fabricante_id' => 'required|exists:fabricantes,id',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string',
            'distribuidor_id' => 'required|exists:distribuidors,id',
            'data_compra' => 'required|date',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|string',  // A imagem é uma string
            'nota' => 'nullable|string|max:100',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $produto->update($request->all());

        return response()->json($produto);
    }

    // Deletar um produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso.']);
    }
}
