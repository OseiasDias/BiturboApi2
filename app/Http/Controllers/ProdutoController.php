<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'data_compra' => 'required|date',
            'nome' => 'required|string|max:100',
            'galho' => 'required|string',
            'fabricante' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'unidade_medida' => 'required|string|max:255',
            'fornecedor' => 'required|string|max:255',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|string|max:255', // Validando o campo imagem como uma URL
            'nota' => 'nullable|string',
            'nota_arquivos' => 'nullable|string',
            'interna' => 'boolean',
            'compartilhada' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verifica se o campo imagem foi enviado e faz o upload
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $path = $imagem->store('produtos', 's3'); // O segundo parâmetro é o disco configurado no S3
            $imagemUrl = Storage::disk('s3')->url($path); // Gera a URL pública do arquivo

            // Agora podemos armazenar a URL da imagem no banco de dados
            $request->merge(['imagem' => $imagemUrl]);
        }

        // Cria o novo produto
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
            'data_compra' => 'sometimes|required|date',
            'nome' => 'sometimes|required|string|max:100',
            'galho' => 'sometimes|required|string',
            'fabricante' => 'sometimes|required|string|max:255',
            'preco' => 'sometimes|required|numeric',
            'unidade_medida' => 'sometimes|required|string|max:255',
            'fornecedor' => 'sometimes|required|string|max:255',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|string|max:255', // Validando o campo imagem como uma URL
            'nota' => 'nullable|string',
            'nota_arquivos' => 'nullable|string',
            'interna' => 'boolean',
            'compartilhada' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verifica se o campo imagem foi enviado e faz o upload
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $path = $imagem->store('produtos', 's3');
            $imagemUrl = Storage::disk('s3')->url($path);
            
            // Atualiza a URL da imagem
            $produto->imagem = $imagemUrl;
        }

        // Atualiza os dados do produto
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
