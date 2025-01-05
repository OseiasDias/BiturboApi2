<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeSuporteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\TipoVeiculoController;




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
Route::put('distribuidores/{id}', [DistribuidorController::class, 'update']);
Route::delete('distribuidores/{id}', [DistribuidorController::class, 'destroy']); // Para deletar um distribuidor


//Routes para funcionarios

// routes/api.php (para APIs)


Route::get('funcionarios', [FuncionarioController::class, 'index']);
Route::get('funcionarios/{id}', [FuncionarioController::class, 'show']);
Route::post('funcionarios', [FuncionarioController::class, 'store']);
Route::put('funcionarios/{id}', [FuncionarioController::class, 'update']);
Route::delete('funcionarios/{id}', [FuncionarioController::class, 'destroy']);


//ROutes para Clientes




Route::get('clientes', [ClienteController::class, 'index']);
Route::get('clientes/{id}', [ClienteController::class, 'show']);
Route::post('clientes', [ClienteController::class, 'store']);
Route::put('clientes/{id}', [ClienteController::class, 'update']);
Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);


//Routes Produtos


Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index']);  // Lista produtos
    Route::post('/', [ProdutoController::class, 'store']); // Cria novo produto
    Route::get('{id}', [ProdutoController::class, 'show']);  // Exibe produto
    Route::put('{id}', [ProdutoController::class, 'update']); // Atualiza produto
    Route::delete('{id}', [ProdutoController::class, 'destroy']); // Deleta produto
});


//// Routes para compras


Route::get('compras', [CompraController::class, 'index']); // Listar todas as compras
Route::post('compras', [CompraController::class, 'store']); // Criar uma nova compra
Route::get('compras/{id}', [CompraController::class, 'show']); // Mostrar uma compra específica
Route::put('compras/{id}', [CompraController::class, 'update']); // Atualizar uma compra específica
Route::delete('compras/{id}', [CompraController::class, 'destroy']); // Deletar uma compra específica


//ROUtes veiculos

Route::prefix('veiculos')->group(function () {
    Route::get('/', [VeiculoController::class, 'index']);
    Route::get('/{id}', [VeiculoController::class, 'show']);
    Route::post('/', [VeiculoController::class, 'store']);
    Route::put('/{id}', [VeiculoController::class, 'update']);
    Route::delete('/{id}', [VeiculoController::class, 'destroy']);
});


//Routes tipo de veiculos

// routes/api.php



Route::prefix('tipos-veiculos')->group(function () {
    Route::get('/', [TipoVeiculoController::class, 'index']); // Listar todos os tipos
    Route::post('/', [TipoVeiculoController::class, 'store']); // Criar um novo tipo de veículo
    Route::get('{id}', [TipoVeiculoController::class, 'show']); // Exibir um tipo de veículo específico
    Route::put('{id}', [TipoVeiculoController::class, 'update']); // Atualizar um tipo de veículo
    Route::delete('{id}', [TipoVeiculoController::class, 'destroy']); // Excluir um tipo de veículo
});
