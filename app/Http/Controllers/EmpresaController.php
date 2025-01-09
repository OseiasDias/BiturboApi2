<?php

// app/Http/Controllers/EmpresaController.php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    // Listar todas as empresas
    public function index()
    {
        $empresas = Empresa::all();
        return response()->json($empresas);
    }

    // Criar uma nova empresa
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_empresa' => 'required|string|max:255',
            'nif_empresa' => 'required|string|max:255|unique:empresas,nif_empresa',
            'tipo_empresa' => 'required|string',
            'setor_empresa' => 'required|string',
            'site_empresa' => 'nullable|url',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|unique:empresas,email',
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'data_criacao' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $empresa = Empresa::create($request->all());
        return response()->json($empresa, 201);
    }

    // Detalhes de uma empresa
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json($empresa);
    }

    // Atualizar uma empresa
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());
        return response()->json($empresa);
    }

    // Deletar uma empresa
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Empresa deletada com sucesso.']);
    }
}
