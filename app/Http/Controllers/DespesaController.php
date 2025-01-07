<?php
namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    // Método para listar todas as despesas
    public function index()
    {
        $despesas = Despesa::all();
        return response()->json($despesas);
    }

    // Método para armazenar uma nova despesa
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'rotulo_principal' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'data_recebimento' => 'required|date',
            'galho' => 'required|string|max:100',
            'entrada_despesa' => 'required|numeric',
            'rotulo_despesa' => 'nullable|string|max:255',
        ]);

        // Criação de uma nova despesa
        $despesa = Despesa::create($request->all());

        return response()->json($despesa, 201); // Retorna a despesa criada com código 201
    }

    // Método para mostrar os detalhes de uma despesa específica
    public function show($id)
    {
        $despesa = Despesa::findOrFail($id);
        return response()->json($despesa);
    }

    // Método para atualizar uma despesa específica
    public function update(Request $request, $id)
    {
        $despesa = Despesa::findOrFail($id);

        // Validação dos dados recebidos
        $request->validate([
            'rotulo_principal' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'data_recebimento' => 'required|date',
            'galho' => 'required|string|max:100',
            'entrada_despesa' => 'required|numeric',
            'rotulo_despesa' => 'nullable|string|max:255',
        ]);

        // Atualização dos dados da despesa
        $despesa->update($request->all());

        return response()->json($despesa);
    }

    // Método para deletar uma despesa
    public function destroy($id)
    {
        Despesa::destroy($id);
        return response()->json(null, 204); // Retorna código 204 para sucesso sem conteúdo
    }
}
