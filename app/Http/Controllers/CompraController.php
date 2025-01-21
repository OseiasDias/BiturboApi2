<?php

// app/Http/Controllers/CompraController.php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Filial;
use App\Models\Distribuidor;
use App\Models\Fabricante;
use App\Models\Produto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Método para listar todas as compras
    public function index()
    {
        // Retorna todas as compras
        $compras = Compra::all();
        return response()->json($compras);
    }

    // Método para mostrar os detalhes de uma compra específica
    public function show($id)
    {
        // Tenta encontrar a compra pelo ID
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        return response()->json($compra);
    }

    // Método para criar uma nova compra
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'data_compra' => 'required|date',
            'filial_id' => 'required|exists:filiais,id',
            'distribuidor_id' => 'required|exists:distribuidores,id',
            'celular' => 'required|string',
            'email' => 'required|email',
            'endereco' => 'required|string',
            'texto_nota' => 'nullable|string|max:100',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
            'fabricante_id' => 'nullable|exists:fabricantes,id',
            'produto_id' => 'nullable|exists:produtos,id',
            'quantidade' => 'nullable|integer',
            'preco' => 'nullable|numeric',
            'preco_total' => 'nullable|numeric',
            'nota_arquivos' => 'nullable|string',  // Alterado para string
        ]);

        // Processando arquivos de nota (se houver)
        $notaArquivos = [];
        if ($request->hasFile('nota_arquivos')) {
            foreach ($request->file('nota_arquivos') as $file) {
                $notaArquivos[] = $file->store('notas');
            }
            // Transformando a lista de caminhos em uma string separada por vírgulas
            $notaArquivosString = implode(',', $notaArquivos);
        } else {
            $notaArquivosString = null;  // Se não houver arquivos, será null
        }

        // Criando a compra
        $compra = Compra::create([
            'data_compra' => $request->data_compra,
            'filial_id' => $request->filial_id,
            'distribuidor_id' => $request->distribuidor_id,
            'celular' => $request->celular,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'texto_nota' => $request->texto_nota,
            'interna' => $request->interna,
            'compartilhada' => $request->compartilhada,
            'fabricante_id' => $request->fabricante_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'preco' => $request->preco,
            'preco_total' => $request->preco_total,
            'nota_arquivos' => $notaArquivosString, // Armazenando os caminhos dos arquivos
        ]);

        return response()->json(['message' => 'Compra criada com sucesso!', 'compra' => $compra], 201);
    }

    // Método para atualizar uma compra existente
    public function update(Request $request, $id)
    {
        // Procurando a compra pelo ID
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        // Validação
        $request->validate([
            'data_compra' => 'required|date',
            'filial_id' => 'required|exists:filiais,id',
            'distribuidor_id' => 'required|exists:distribuidores,id',
            'celular' => 'required|string',
            'email' => 'required|email',
            'endereco' => 'required|string',
            'texto_nota' => 'nullable|string|max:100',
            'interna' => 'nullable|boolean',
            'compartilhada' => 'nullable|boolean',
            'fabricante_id' => 'nullable|exists:fabricantes,id',
            'produto_id' => 'nullable|exists:produtos,id',
            'quantidade' => 'nullable|integer',
            'preco' => 'nullable|numeric',
            'preco_total' => 'nullable|numeric',
            'nota_arquivos' => 'nullable|string',  // Alterado para string
        ]);

        // Processando arquivos de nota (se houver)
        $notaArquivos = [];
        if ($request->hasFile('nota_arquivos')) {
            foreach ($request->file('nota_arquivos') as $file) {
                $notaArquivos[] = $file->store('notas');
            }
            // Transformando a lista de caminhos em uma string separada por vírgulas
            $notaArquivosString = implode(',', $notaArquivos);
        } else {
            $notaArquivosString = $compra->nota_arquivos; // Não altera caso não haja novo arquivo
        }

        // Atualizando a compra
        $compra->update([
            'data_compra' => $request->data_compra,
            'filial_id' => $request->filial_id,
            'distribuidor_id' => $request->distribuidor_id,
            'celular' => $request->celular,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'texto_nota' => $request->texto_nota,
            'interna' => $request->interna,
            'compartilhada' => $request->compartilhada,
            'fabricante_id' => $request->fabricante_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'preco' => $request->preco,
            'preco_total' => $request->preco_total,
            'nota_arquivos' => $notaArquivosString, // Atualizando os caminhos dos arquivos
        ]);

        return response()->json(['message' => 'Compra atualizada com sucesso!', 'compra' => $compra]);
    }

    // Método para excluir uma compra
    public function destroy($id)
    {
        // Procurando a compra pelo ID
        $compra = Compra::find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        // Deletando a compra
        $compra->delete();

        return response()->json(['message' => 'Compra deletada com sucesso!']);
    }
}

