<?php

namespace App\Http\Controllers;

use App\Models\Factura;
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
        $request->validate([
            'numero_fatura' => 'required|unique:facturas',
            'cliente_id' => 'required|exists:clientes,id',
            'ordem_servico_id' => 'required|exists:ordens_de_servico,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'valor_pago' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'data' => 'required|date',
            'filiais' => 'required|string',
            'status' => 'required|string',
            'tipo_pagamento' => 'required|string',
            'valor_total' => 'required|numeric',
            'tipo_fatura' => 'required|string',
        ]);

        $factura = Factura::create($request->all());

        return response()->json(['message' => 'Fatura criada com sucesso!', 'data' => $factura], 201);
    }

    // Método para atualizar uma fatura existente
    public function update(Request $request, $id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        $request->validate([
            'numero_fatura' => "required|unique:facturas,numero_fatura,$id", // Permite que o número da fatura do próprio ID seja atualizado
            'cliente_id' => 'required|exists:clientes,id',
            'ordem_servico_id' => 'required|exists:ordens_de_servico,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'valor_pago' => 'required|numeric',
            'desconto' => 'nullable|numeric',
            'data' => 'required|date',
            'filiais' => 'required|string',
            'status' => 'required|string',
            'tipo_pagamento' => 'required|string',
            'valor_total' => 'required|numeric',
            'tipo_fatura' => 'required|string',
        ]);

        $factura->update($request->all());

        return response()->json(['message' => 'Fatura atualizada com sucesso!', 'data' => $factura], 200);
    }

    // Método para deletar uma fatura
    public function destroy($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        $factura->delete();

        return response()->json(['message' => 'Fatura deletada com sucesso!'], 200);
    }
}
