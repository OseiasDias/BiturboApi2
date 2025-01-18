<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    // Exibe todos os veículos
    public function index()
    {
        $veiculos = Veiculo::with('cliente')->get(); // Relacionando com o cliente
        return response()->json($veiculos);
    }

    // Exibe um veículo específico
    public function show($id)
    {
        $veiculo = Veiculo::with('cliente')->find($id);

        if (!$veiculo) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }

        return response()->json($veiculo);
    }

    // Cria um novo veículo
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'tipo_veiculo' => 'required',
            'numero_placa' => 'required|string|unique:veiculos,numero_placa',
            'marca_veiculo' => 'required|string',
            'modelo_veiculo' => 'required|string',
            'preco' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id',
            'combustivel' => 'required',
            'imagens' => 'nullable|array',  // O campo "imagens" pode ser um array ou nulo
            'imagens.*' => 'url',           // Se "imagens" for um array, cada item deve ser uma URL válida
            'descricao' => 'nullable|string',
            'cor' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Verifica se a requisição contém imagens
        $imagens = [];
        if ($request->has('imagens')) {
            foreach ($request->imagens as $imagem) {
                $imagens[] = $imagem; // Aqui é apenas a URL das imagens
            }
        }
    
        // Converte o array de imagens para JSON
        $imagensJson = json_encode($imagens);
    
        // Criação do veículo
        $veiculo = Veiculo::create(array_merge($request->all(), ['imagens' => $imagensJson]));
    
        return response()->json($veiculo, 201);
    }
    

    // Atualiza um veículo
    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::find($id);
    
        if (!$veiculo) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }
    
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'tipo_veiculo' => 'required',
            'numero_placa' => 'required|string|unique:veiculos,numero_placa,' . $id,
            'marca_veiculo' => 'required|string',
            'modelo_veiculo' => 'required|string',
            'preco' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id',
            'combustivel' => 'required',
            'imagens' => 'nullable|array',  // O campo "imagens" pode ser um array ou nulo
            'imagens.*' => 'url',           // Se "imagens" for um array, cada item deve ser uma URL válida
            'descricao' => 'nullable|string',
            'cor' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Atualiza as imagens, se fornecidas
        $imagens = [];
        if ($request->has('imagens')) {
            foreach ($request->imagens as $imagem) {
                $imagens[] = $imagem;
            }
        }
    
        // Converte o array de imagens para JSON
        $imagensJson = json_encode($imagens);
    
        // Atualiza o veículo com os dados fornecidos
        $veiculo->update(array_merge($request->all(), ['imagens' => $imagensJson]));
    
        return response()->json($veiculo);
    }
    

    // Exibe todos os veículos de um cliente específico
public function getVeiculosByCliente($clienteId)
{
    // Verifica se o cliente existe
    $cliente = Cliente::find($clienteId);

    if (!$cliente) {
        return response()->json(['message' => 'Cliente não encontrado'], 404);
    }

    // Busca todos os veículos associados ao cliente
    $veiculos = Veiculo::where('cliente_id', $clienteId)->get();

    if ($veiculos->isEmpty()) {
        return response()->json(['message' => 'Nenhum veículo encontrado para este cliente'], 404);
    }

    return response()->json($veiculos);
}


    // Deleta um veículo
    public function destroy($id)
    {
        $veiculo = Veiculo::find($id);

        if (!$veiculo) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }

        $veiculo->delete();

        return response()->json(['message' => 'Veículo excluído com sucesso']);
    }
}
