<?php

// app/Http/Controllers/AdministradorController.php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministradorController extends Controller
{
    // Listar todos os administradores
    public function index()
    {
        $administradores = Administrador::all();
        return response()->json($administradores);
    }

    // Criar um novo administrador
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'email' => 'required|email|unique:administradores,email',
            'senha' => 'required|string|min:8',
            'celular' => 'required|string|max:255|unique:administradores,celular',
            'filial' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'data_admissao' => 'required|date',
            'pais' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'endereco' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $administrador = Administrador::create($request->all());
        return response()->json($administrador, 201);
    }

    // Detalhes de um administrador
    public function show($id)
    {
        $administrador = Administrador::findOrFail($id);
        return response()->json($administrador);
    }

    // Atualizar um administrador
    public function update(Request $request, $id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->update($request->all());
        return response()->json($administrador);
    }

    // Deletar um administrador
    public function destroy($id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->delete();
        return response()->json(['message' => 'Administrador deletado com sucesso.']);
    }

    // Método de login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (Auth::attempt(['email' => $request->email, 'senha' => $request->senha])) {
            $administrador = Auth::user();
            return response()->json(['token' => $administrador->createToken('API Token')->plainTextToken]);
        }

        return response()->json(['message' => 'Credenciais inválidas.'], 401);
    }
}
