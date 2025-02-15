<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        // Retorna todos os serviços
        $servicos = Servico::all();
        return response()->json($servicos);
    }

    public function store(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'nome_servico' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'preco' => 'required|numeric|min:0', // Validação para o campo preco
        ]);

        // Cria o novo serviço
        $servico = Servico::create([
            'nome_servico' => $request->nome_servico,
            'descricao' => $request->descricao,
            'preco' => $request->preco, // Inclui o preco na criação
        ]);

        // Retorna o serviço criado com status 201
        return response()->json($servico, 201);
    }

    public function show($id)
    {
        // Encontra o serviço com o id fornecido ou retorna erro 404
        $servico = Servico::findOrFail($id);
        return response()->json($servico);
    }

    public function update(Request $request, $id)
    {
        // Encontra o serviço com o id fornecido ou retorna erro 404
        $servico = Servico::findOrFail($id);

        // Valida os dados recebidos
        $request->validate([
            'nome_servico' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'preco' => 'required|numeric|min:0', // Validação para o campo preco
        ]);

        // Atualiza os dados do serviço
        $servico->update([
            'nome_servico' => $request->nome_servico,
            'descricao' => $request->descricao,
            'preco' => $request->preco, // Atualiza o preco
        ]);

        // Retorna o serviço atualizado
        return response()->json($servico);
    }

    public function destroy($id)
    {
        // Encontra o serviço com o id fornecido ou retorna erro 404
        Servico::destroy($id);

        // Retorna um status de sucesso com código 204 (sem conteúdo)
        return response()->json(null, 204);
    }
}
