<?php

namespace App\Http\Controllers;

use App\Models\Distribuidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DistribuidorController extends Controller
{
    // Exibir todos os distribuidores
    public function index()
    {
        $distribuidores = Distribuidor::all();
        return response()->json($distribuidores);
    }

    // Exibir um único distribuidor
    public function show($id)
    {
        $distribuidor = Distribuidor::find($id);

        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor não encontrado'], 404);
        }

        return response()->json($distribuidor);
    }

    // Criar um novo distribuidor
    public function store(Request $request)
    {
        // Validar os dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'required|string|max:50',
            'ultimo_nome' => 'required|string|max:50',
            'nome_empresa' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:distribuidores',
            'celular' => 'required|string|max:16|unique:distribuidores',
            'telefone_fixo' => 'nullable|string|max:16',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genero' => 'nullable|string|in:Masculino,Feminino',
            'pais' => 'required|string|max:100',
            'estado' => 'nullable|string|max:100',
            'municipio' => 'nullable|string|max:100',
            'endereco' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Preparar dados para inserção
        $distribuidorData = $request->only([
            'primeiro_nome', 'ultimo_nome', 'nome_empresa', 'email', 
            'celular', 'telefone_fixo', 'genero', 'pais', 'estado', 
            'municipio', 'endereco'
        ]);
    
        // Se uma imagem for enviada
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('distribuidores', 'public');
            $distribuidorData['imagem'] = $imagemPath;
        }
    
        // Criar o distribuidor
        $distribuidor = Distribuidor::create($distribuidorData);
    
        return response()->json($distribuidor, 201);
    }

    // Atualizar distribuidor
    public function update(Request $request, $id)
    {
        $distribuidor = Distribuidor::find($id);
    
        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor não encontrado'], 404);
        }
    
        // Validar os dados
        $validator = Validator::make($request->all(), [
            'primeiro_nome' => 'nullable|string|max:50',
            'ultimo_nome' => 'nullable|string|max:50',
            'nome_empresa' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:50|unique:distribuidores,email,' . $distribuidor->id,
            'celular' => 'nullable|string|max:16|unique:distribuidores,celular,' . $distribuidor->id,
            'telefone_fixo' => 'nullable|string|max:16',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genero' => 'nullable|string|in:Masculino,Feminino',
            'pais' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'municipio' => 'nullable|string|max:100',
            'endereco' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Atualizar dados
        $distribuidorData = $request->only([
            'primeiro_nome', 'ultimo_nome', 'nome_empresa', 'email', 
            'celular', 'telefone_fixo', 'genero', 'pais', 'estado', 
            'municipio', 'endereco'
        ]);
    
        // Se uma imagem foi enviada, armazenar
        if ($request->hasFile('imagem')) {
            if ($distribuidor->imagem) {
                Storage::disk('public')->delete($distribuidor->imagem);
            }
    
            $imagemPath = $request->file('imagem')->store('distribuidores', 'public');
            $distribuidorData['imagem'] = $imagemPath;
        }
    
        // Atualizar o distribuidor
        $distribuidor->update($distribuidorData);
    
        return response()->json($distribuidor);
    }

    // Excluir distribuidor
    public function destroy($id)
    {
        $distribuidor = Distribuidor::find($id);

        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor não encontrado'], 404);
        }

        // Excluir a imagem, se existir
        if ($distribuidor->imagem) {
            Storage::disk('public')->delete($distribuidor->imagem);
        }

        $distribuidor->delete();

        return response()->json(['message' => 'Distribuidor excluído com sucesso']);
    }
}
