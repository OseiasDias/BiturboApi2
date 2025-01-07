<?php

namespace App\Http\Controllers;

use App\Models\Renda;
use Illuminate\Http\Request;

class RendaController extends Controller
{
    public function index()
    {
        // Retorna todas as rendas
        $rendas = Renda::all();
        return response()->json($rendas);
    }

    public function store(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'fatura' => 'required|string|max:255',
            'valor_pendente' => 'nullable|numeric',
            'status' => 'required|string|max:50', // Agora status é uma string
            'rotulo_principal' => 'required|string|max:255',
            'data_recebimento' => 'required|date',
            'tipo_pagamento' => 'required|string|max:50', // Agora tipo_pagamento é uma string
            'galho' => 'required|string|max:100',
            'entrada_renda' => 'required|numeric',
            'rotulo_renda' => 'nullable|string|max:255', // Rotulo renda é opcional
        ]);

        // Cria a nova renda
        $renda = Renda::create($request->all());

        // Retorna a renda criada com status 201
        return response()->json($renda, 201);
    }

    public function show($id)
    {
        // Encontra a renda com o id fornecido ou retorna erro 404
        $renda = Renda::findOrFail($id);
        return response()->json($renda);
    }

    public function update(Request $request, $id)
    {
        // Encontra a renda com o id fornecido ou retorna erro 404
        $renda = Renda::findOrFail($id);

        // Valida os dados recebidos
        $request->validate([
            'fatura' => 'required|string|max:255',
            'valor_pendente' => 'nullable|numeric',
            'status' => 'required|string|max:50',
            'rotulo_principal' => 'required|string|max:255',
            'data_recebimento' => 'required|date',
            'tipo_pagamento' => 'required|string|max:50',
            'galho' => 'required|string|max:100',
            'entrada_renda' => 'required|numeric',
            'rotulo_renda' => 'nullable|string|max:255',
        ]);

        // Atualiza os dados da renda
        $renda->update($request->all());

        // Retorna a renda atualizada
        return response()->json($renda);
    }

    public function destroy($id)
    {
        // Encontra a renda com o id fornecido ou retorna erro 404
        Renda::destroy($id);
        
        // Retorna um status de sucesso com código 204 (sem conteúdo)
        return response()->json(null, 204);
    }
}
