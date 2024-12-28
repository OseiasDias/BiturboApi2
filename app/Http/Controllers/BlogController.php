<?php

// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    // Exibir todos os blogs
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    // Exibir um único blog
    public function show($id)
    {
        $blog = Blog::find($id);
    
        if (!$blog) {
            return response()->json(['message' => 'Blog não encontrado'], 404);
        }
    
        return response()->json($blog);
    }
    

    // Criar um novo blog
// app/Http/Controllers/BlogController.php
public function store(Request $request)
{
    // Validar os dados recebidos
    $validator = Validator::make($request->all(), [
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação da foto
        'data_publicacao' => 'required|date', // Validação da data de publicação
        'autor' => 'required|string|max:255', // Validação do autor
    ]);

    // Se a validação falhar, retorna os erros
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Preparar o dado do blog
    $blogData = $request->only(['titulo', 'conteudo', 'data_publicacao', 'autor']);

    // Se a foto foi enviada
    if ($request->hasFile('foto')) {
        // Salvar a foto no diretório 'public/blogs' e obter o caminho
        $fotoPath = $request->file('foto')->store('blogs', 'public');
        $blogData['foto'] = $fotoPath;
    }

    // Criar o blog
    $blog = Blog::create($blogData);

    // Retornar o blog criado com sucesso
    return response()->json($blog, 201);
}


public function update(Request $request, $id)
{
    // Encontra o blog
    $blog = Blog::find($id);
    
    if (!$blog) {
        return response()->json(['message' => 'Blog não encontrado'], 404);
    }

    // Validar os dados
    $validator = Validator::make($request->all(), [
        'titulo' => 'nullable|string|max:255',
        'conteudo' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'data_publicacao' => 'nullable|date',
        'autor' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Atualizar os campos
    $blogData = $request->only(['titulo', 'conteudo', 'data_publicacao', 'autor']);
    
    if ($request->hasFile('foto')) {
        // Se houver uma foto, salva e atualiza o campo
        $fotoPath = $request->file('foto')->store('blogs', 'public');
        $blogData['foto'] = $fotoPath;
    }

    // Atualiza o blog com os novos dados
    $blog->update($blogData);

    return response()->json($blog);
}

    
    // Excluir um blog
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog não encontrado'], 404);
        }

        // Excluir a foto se existir
        if ($blog->foto) {
            Storage::disk('public')->delete($blog->foto);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog excluído com sucesso']);
    }
}
