<?php
// app/Http/Controllers/AgendamentoController.php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    // Listar todos os agendamentos
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'veiculo', 'servico'])->get();
        return response()->json($agendamentos);
    }

    // Criar um novo agendamento
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'id_cliente' => 'required|exists:clientes,id',
            'id_veiculo' => 'required|exists:veiculos,id',
            'id_servico' => 'required|exists:servicos,id',
            'status' => 'required|string',
            'descricao' => 'nullable|string',
            'motivoAdiar' => 'nullable|string',
        ]);

        $agendamento = Agendamento::create($request->all());
        return response()->json($agendamento, 201);
    }

    // Mostrar um agendamento específico
    public function show($id)
    {
        $agendamento = Agendamento::with(['cliente', 'veiculo', 'servico'])->findOrFail($id);
        return response()->json($agendamento);
    }

    // Atualizar um agendamento
    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required|date',
            'id_cliente' => 'required|exists:clientes,id',
            'id_veiculo' => 'required|exists:veiculos,id',
            'id_servico' => 'required|exists:servicos,id',
            'status' => 'required|string',
            'descricao' => 'nullable|string',
            'motivoAdiar' => 'nullable|string',
        ]);

        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());
        return response()->json($agendamento);
    }

    // Deletar um agendamento
    public function destroy($id)
    {
        Agendamento::destroy($id);
        return response()->json(null, 204);
    }
}
