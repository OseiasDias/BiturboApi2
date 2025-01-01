<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeSuporteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DistribuidorController;

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


//Routes Para equipe de suporte


Route::get('equipe-suporte', [EquipeSuporteController::class, 'index']); // Para listar todos
Route::get('equipe-suporte/{id}', [EquipeSuporteController::class, 'show']); // Para mostrar um único registro
Route::post('equipe-suporte', [EquipeSuporteController::class, 'store']); // Para criar um novo
Route::put('equipe-suporte/{id}', [EquipeSuporteController::class, 'update']); // Para atualizar um registro
Route::delete('equipe-suporte/{id}', [EquipeSuporteController::class, 'destroy']); // Para deletar um registro
Route::post('equipe-suporte/login', [EquipeSuporteController::class, 'login']);


//ROutes Model

Route::get('blogs', [BlogController::class, 'index']); // Listar todos os blogs
Route::get('blogs/{id}', [BlogController::class, 'show']); // Exibir um blog específico
Route::post('blogs', [BlogController::class, 'store']); // Criar um novo blog
Route::put('blogs/{id}', [BlogController::class, 'update']); // Atualizar um blog
Route::delete('blogs/{id}', [BlogController::class, 'destroy']); // Excluir um blog

//Routes do fornecedor




Route::get('distribuidores', [DistribuidorController::class, 'index']); // Para listar todos os distribuidores
Route::get('distribuidores/{id}', [DistribuidorController::class, 'show']); // Para mostrar um único distribuidor
Route::post('distribuidores', [DistribuidorController::class, 'store']); // Para criar um novo distribuidor
Route::put('distribuidores/{id}', [DistribuidorController::class, 'update']); // Para atualizar um distribuidor
Route::delete('distribuidores/{id}', [DistribuidorController::class, 'destroy']); // Para deletar um distribuidor
