<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\Veiculo;
use App\Models\Filial;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Método para listar todas as faturas
    public function index()
    {
        $facturas = Factura::all();
        return response()->json(['data' => $facturas], 200);
    }

    // Método para exibir uma fatura específica
    public function show($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        return response()->json(['data' => $factura], 200);
    }

    // Método para criar uma nova fatura
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'numero_fatura' => 'required|unique:facturas',
            'cliente_id' => 'required|exists:clientes,id',
            'ordem_servico_id' => 'required|exists:ordens_servico,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'valor_pago' => 'required|numeric',
            'data' => 'required|date',
            'filial_id' => 'required|exists:filiais,id',
            'status' => 'required|string',
            'tipo_pagamento' => 'required|string',
            'valor_total' => 'required|numeric',
            'tipo_fatura' => 'required|string',
        ]);

        // Criação da fatura
        $factura = Factura::create([
            'numero_fatura' => $request->numero_fatura,
            'cliente_id' => $request->cliente_id,
            'ordem_servico_id' => $request->ordem_servico_id,
            'veiculo_id' => $request->veiculo_id,
            'valor_pago' => $request->valor_pago,
            'desconto' => $request->desconto,
            'data' => $request->data,
            'filial_id' => $request->filial_id,
            'status' => $request->status,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor_total' => $request->valor_total,
            'detalhes' => $request->detalhes,
            'tipo_fatura' => $request->tipo_fatura,
        ]);

        return response()->json(['message' => 'Fatura criada com sucesso!', 'data' => $factura], 201);
    }

    // Método para atualizar uma fatura existente
    public function update(Request $request, $id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        // Validação
        $request->validate([
            'numero_fatura' => 'required|unique:facturas,numero_fatura,' . $id,
            'cliente_id' => 'required|exists:clientes,id',
            'ordem_servico_id' => 'required|exists:ordens_servico,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'valor_pago' => 'required|numeric',
            'data' => 'required|date',
            'filial_id' => 'required|exists:filiais,id',
            'status' => 'required|string',
            'tipo_pagamento' => 'required|string',
            'valor_total' => 'required|numeric',
            'tipo_fatura' => 'required|string',
        ]);

        // Atualização da fatura
        $factura->update([
            'numero_fatura' => $request->numero_fatura,
            'cliente_id' => $request->cliente_id,
            'ordem_servico_id' => $request->ordem_servico_id,
            'veiculo_id' => $request->veiculo_id,
            'valor_pago' => $request->valor_pago,
            'desconto' => $request->desconto,
            'data' => $request->data,
            'filial_id' => $request->filial_id,
            'status' => $request->status,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor_total' => $request->valor_total,
            'detalhes' => $request->detalhes,
            'tipo_fatura' => $request->tipo_fatura,
        ]);

        return response()->json(['message' => 'Fatura atualizada com sucesso!', 'data' => $factura], 200);
    }

    // Método para deletar uma fatura
    public function destroy($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        // Deletar fatura
        $factura->delete();

        return response()->json(['message' => 'Fatura deletada com sucesso!'], 200);
    }
}
