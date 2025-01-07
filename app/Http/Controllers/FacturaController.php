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
    // Validação dos dados da requisição
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
        'km_entrada' => 'required|numeric',
        'data_inicial_entrada' => 'required|date',
        'data_final_saida' => 'required|date',
        'garantia_dias' => 'nullable|integer',
        'defeito_ou_servico' => 'nullable|string',
        'observacoes' => 'nullable|string',
        'laudo_tecnico' => 'nullable|string',
        // Adicionando a validação para o campo detalhes
        'detalhes' => 'nullable|string', // Permite que detalhes seja opcional e do tipo string
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
        'filiais' => $request->filiais,
        'status' => $request->status,
        'tipo_pagamento' => $request->tipo_pagamento,
        'valor_total' => $request->valor_total,
        'tipo_fatura' => $request->tipo_fatura,
        'km_entrada' => $request->km_entrada,
        'data_inicial_entrada' => $request->data_inicial_entrada,
        'data_final_saida' => $request->data_final_saida,
        'garantia_dias' => $request->garantia_dias,
        'defeito_ou_servico' => $request->defeito_ou_servico,
        'observacoes' => $request->observacoes,
        'laudo_tecnico' => $request->laudo_tecnico,
        // Adicionando o campo detalhes na criação
        'detalhes' => $request->detalhes,
    ]);

    return response()->json(['message' => 'Fatura criada com sucesso!', 'data' => $factura], 201);
}


    // Método para atualizar uma fatura existente
    public function update(Request $request, $id)
    {
        // Busca pela fatura com o ID
        $factura = Factura::find($id);
    
        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }
    
        // Validação dos dados da requisição
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
            'km_entrada' => 'required|numeric',
            'data_inicial_entrada' => 'required|date',
            'data_final_saida' => 'required|date',
            'garantia_dias' => 'nullable|integer',
            'defeito_ou_servico' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'laudo_tecnico' => 'nullable|string',
            // Adicionando a validação para o campo detalhes
            'detalhes' => 'nullable|string', // Permite que detalhes seja opcional e do tipo string
        ]);
    
        // Atualização dos dados da fatura
        $factura->update([
            'numero_fatura' => $request->numero_fatura,
            'cliente_id' => $request->cliente_id,
            'ordem_servico_id' => $request->ordem_servico_id,
            'veiculo_id' => $request->veiculo_id,
            'valor_pago' => $request->valor_pago,
            'desconto' => $request->desconto,
            'data' => $request->data,
            'filiais' => $request->filiais,
            'status' => $request->status,
            'tipo_pagamento' => $request->tipo_pagamento,
            'valor_total' => $request->valor_total,
            'tipo_fatura' => $request->tipo_fatura,
            'km_entrada' => $request->km_entrada,
            'data_inicial_entrada' => $request->data_inicial_entrada,
            'data_final_saida' => $request->data_final_saida,
            'garantia_dias' => $request->garantia_dias,
            'defeito_ou_servico' => $request->defeito_ou_servico,
            'observacoes' => $request->observacoes,
            'laudo_tecnico' => $request->laudo_tecnico,
            // Adicionando o campo detalhes na atualização
            'detalhes' => $request->detalhes,
        ]);
    
        return response()->json(['message' => 'Fatura atualizada com sucesso!', 'data' => $factura], 200);
    }
    

    // Método para deletar uma fatura
    public function destroy($id)
    {
        // Busca pela fatura
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Fatura não encontrada'], 404);
        }

        // Deletando a fatura
        $factura->delete();

        return response()->json(['message' => 'Fatura deletada com sucesso!'], 200);
    }
}
