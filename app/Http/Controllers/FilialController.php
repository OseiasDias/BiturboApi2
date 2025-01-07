<?php
namespace App\Http\Controllers;

use App\Models\Filial;
use Illuminate\Http\Request;

class FilialController extends Controller
{
    public function index()
    {
        // Retorna todas as filials
        $filials = Filial::all();
        return response()->json($filials);
    }

    public function store(Request $request)
    {
        // Valida os dados recebidos
        $request->validate([
            'nome_filial' => 'required|string|max:50',
            'numero_contato' => 'required|string|max:16',
            'email' => 'required|string|email|max:50',
            'imagem' => 'nullable|image',
            'pais_id' => 'required|string',
            'provincia' => 'nullable|string|max:50',
            'municipio' => 'nullable|string|max:50',
            'endereco' => 'required|string|max:100',
        ]);

        // Cria a filial
        $filial = Filial::create($request->all());

        return response()->json($filial, 201);
    }

    public function show($id)
    {
        // Encontra a filial pelo ID
        $filial = Filial::findOrFail($id);
        return response()->json($filial);
    }

    public function update(Request $request, $id)
    {
        // Encontra a filial pelo ID
        $filial = Filial::findOrFail($id);

        // Valida os dados recebidos
        $request->validate([
            'nome_filial' => 'required|string|max:50',
            'numero_contato' => 'required|string|max:16',
            'email' => 'required|string|email|max:50',
            'imagem' => 'nullable|image',
            'pais_id' => 'required|string',
            'provincia' => 'nullable|string|max:50',
            'municipio' => 'nullable|string|max:50',
            'endereco' => 'required|string|max:100',
        ]);

        // Atualiza a filial
        $filial->update($request->all());

        return response()->json($filial);
    }

    public function destroy($id)
    {
        // Encontra e deleta a filial pelo ID
        Filial::destroy($id);
        return response()->json(null, 204);
    }
}
