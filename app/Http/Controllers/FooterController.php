<?php



namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    // Método para salvar os dados
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'telefone' => 'required|string',
            'email' => 'required|email',
            'whatsapp' => 'required|string',
            'rua' => 'required|string',
            'bairro' => 'required|string',
            'municipio' => 'required|string',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        // Criando a entrada no banco de dados
        Footer::create($validated);

        // Retornando uma resposta
        return response()->json(['message' => 'Dados salvos com sucesso!'], 201);
    }

    // Método para visualizar os dados
    public function show($id)
    {
        // Encontrar o footer com o ID
        $footer = Footer::findOrFail($id);

        // Retornar os dados do footer
        return response()->json($footer, 200);
    }

    // Método para listar todos os dados
    public function index()
    {
        // Recuperando todos os dados da tabela 'footers'
        $footers = Footer::all();

        // Retornar todos os dados
        return response()->json($footers, 200);
    }

    // Método para atualizar os dados
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'telefone' => 'required|string',
            'email' => 'required|email',
            'whatsapp' => 'required|string',
            'rua' => 'required|string',
            'bairro' => 'required|string',
            'municipio' => 'required|string',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        // Encontrando o footer e atualizando os dados
        $footer = Footer::findOrFail($id);
        $footer->update($validated);

        // Retornando uma resposta
        return response()->json(['message' => 'Dados atualizados com sucesso!'], 200);
    }

    // Método para deletar os dados
    public function destroy($id)
    {
        // Encontrando o footer e deletando
        $footer = Footer::findOrFail($id);
        $footer->delete();

        // Retornando uma resposta
        return response()->json(['message' => 'Dados deletados com sucesso!'], 200);
    }
}
