<?php

// app/Http/Controllers/OrdemDeServicoController.php

namespace App\Http\Controllers;

use App\Models\OrdemDeServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdemDeServicoController extends Controller
{
    // Exibe todas as ordens de serviço
    public function index()
    {
        $ordens = OrdemDeServico::all();
        return response()->json($ordens);
    }

    // Exibe uma ordem de serviço específica
    public function show($id)
    {
        $ordem = OrdemDeServico::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }

        return response()->json($ordem);
    }

    // Cria uma nova ordem de serviço
    public function store(Request $request)
    {
        // Validação dos dados da ordem de serviço
        $validator = Validator::make($request->all(), [
            'jobno' => 'required|string|max:255',
            'cust_id' => 'required|exists:clientes,id',
            'vhi_id' => 'required|exists:veiculos,id',
            'data_inicial_entrada' => 'required|date',
            'repair_cat' => 'required|in:breakdown,booked vehicle,repeat job,customer waiting',
            'km_entrada' => 'required|integer',
            'charge_required' => 'required|numeric',
            'branch' => 'required|string|max:255',
            'status' => 'required|in:pendente,em andamento,concluido',
            'garantia_dias' => 'required|integer',
            'data_final_saida' => 'required|date',
            'defeito_ou_servico' => 'required|string',
            'images' => 'nullable|array', // Imagens são opcionais, mas se fornecidas, precisam ser um array
            'washbay' => 'nullable|boolean',
            'motTestStatusCheckbox' => 'nullable|boolean',
            'motTestCharge' => 'nullable|numeric',
        ]);

        // Se a validação falhar, retorna os erros
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Processamento das imagens se elas existirem
        $imagensJson = null;
        if ($request->has('images')) {
            // Aqui o campo 'images' deve ser um array de URLs das imagens
            $imagens = [];
            foreach ($request->images as $imagem) {
                // Aqui, você pode adicionar qualquer lógica para processar o arquivo de imagem
                // Se forem URLs, simplesmente adiciona ao array
                $imagens[] = $imagem; 
            }
            // Converte o array de imagens para JSON
            $imagensJson = json_encode($imagens);
        }

        // Criação da ordem de serviço, incluindo as imagens convertidas (se houver)
        $ordem = OrdemDeServico::create(array_merge($request->all(), ['images' => $imagensJson]));

        return response()->json($ordem, 201);
    }

    // Atualiza uma ordem de serviço
    public function update(Request $request, $id)
    {
        $ordem = OrdemDeServico::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }

        // Processamento das imagens (se enviadas) durante a atualização
        $imagensJson = null;
        if ($request->has('images')) {
            // Se as imagens forem fornecidas, processamos da mesma maneira
            $imagens = [];
            foreach ($request->images as $imagem) {
                $imagens[] = $imagem;
            }
            // Converte o array de imagens para JSON
            $imagensJson = json_encode($imagens);
        }

        // Atualiza a ordem de serviço com as imagens processadas (se houver)
        $ordem->update(array_merge($request->all(), ['images' => $imagensJson]));

        return response()->json($ordem);
    }

    // Deleta uma ordem de serviço
    public function destroy($id)
    {
        $ordem = OrdemDeServico::find($id);

        if (!$ordem) {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }

        $ordem->delete();

        return response()->json(['message' => 'Ordem de serviço excluída com sucesso']);
    }
}
