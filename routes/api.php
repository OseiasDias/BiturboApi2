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
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\OrdemDeServicoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\GatepassController;
use App\Http\Controllers\TaxaController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\RendaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\AgendamentoController;






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



//Route Marcas



// Rotas para a entidade Marca
Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index'); // Listar todas as marcas
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store'); // Criar uma nova marca
Route::get('/marcas/{id}', [MarcaController::class, 'show'])->name('marcas.show'); // Mostrar uma marca específica
Route::put('/marcas/{id}', [MarcaController::class, 'update'])->name('marcas.update'); // Atualizar uma marca específica
Route::delete('/marcas/{id}', [MarcaController::class, 'destroy'])->name('marcas.destroy'); // Deletar uma marca específica


//Routes cores

Route::prefix('cores')->group(function () {
    // Rota para listar todas as cores
    Route::get('/', [CorController::class, 'index']);

    // Rota para criar uma nova cor
    Route::post('/', [CorController::class, 'store']);

    // Rota para mostrar uma cor específica pelo ID
    Route::get('{id}', [CorController::class, 'show']);

    // Rota para atualizar uma cor específica pelo ID
    Route::put('{id}', [CorController::class, 'update']);

    // Rota para deletar uma cor específica pelo ID
    Route::delete('{id}', [CorController::class, 'destroy']);
});


// Routes ordem de servico



Route::get('ordens-de-servico', [OrdemDeServicoController::class, 'index']);
Route::get('ordens-de-servico/{id}', [OrdemDeServicoController::class, 'show']);
Route::post('ordens-de-servico', [OrdemDeServicoController::class, 'store']);
Route::put('ordens-de-servico/{id}', [OrdemDeServicoController::class, 'update']);
Route::delete('ordens-de-servico/{id}', [OrdemDeServicoController::class, 'destroy']);

//Faturas Routes

// Rota para listar todas as faturas
Route::get('facturas', [FacturaController::class, 'index']);

// Rota para exibir uma fatura específica
Route::get('facturas/{id}', [FacturaController::class, 'show']);

// Rota para criar uma nova fatura
Route::post('facturas', [FacturaController::class, 'store']);

// Rota para atualizar uma fatura
Route::put('facturas/{id}', [FacturaController::class, 'update']);

// Rota para deletar uma fatura
Route::delete('facturas/{id}', [FacturaController::class, 'destroy']);



//Routes Get Pass

Route::prefix('gatepasses')->group(function() {
    Route::get('/', [GatepassController::class, 'index']);
    Route::get('{id}', [GatepassController::class, 'show']);
    Route::post('/', [GatepassController::class, 'store']);
    Route::put('{id}', [GatepassController::class, 'update']);
    Route::delete('{id}', [GatepassController::class, 'destroy']);
});



//Routes taxas

Route::prefix('taxas')->group(function () {
    Route::get('/', [TaxaController::class, 'index']);
    Route::post('/', [TaxaController::class, 'store']);
    Route::get('{id}', [TaxaController::class, 'show']);
    Route::put('{id}', [TaxaController::class, 'update']);
    Route::delete('{id}', [TaxaController::class, 'destroy']);
});


//Routes metodo de pagamentos




// Rotas para CRUD de métodos de pagamento
Route::get('payment-methods', [PaymentMethodController::class, 'index']);         // Listar todos
Route::get('payment-methods/{id}', [PaymentMethodController::class, 'show']);     // Exibir um único
Route::post('payment-methods', [PaymentMethodController::class, 'store']);        // Criar novo
Route::put('payment-methods/{id}', [PaymentMethodController::class, 'update']);   // Atualizar
Route::delete('payment-methods/{id}', [PaymentMethodController::class, 'destroy']); // Excluir

//ROutes Renda


// Rota para listar todas as rendas
Route::get('rendas', [RendaController::class, 'index']);

// Rota para criar uma nova renda
Route::post('rendas', [RendaController::class, 'store']);

// Rota para exibir uma renda específica
Route::get('rendas/{id}', [RendaController::class, 'show']);

// Rota para atualizar uma renda específica
Route::put('rendas/{id}', [RendaController::class, 'update']);

// Rota para deletar uma renda específica
Route::delete('rendas/{id}', [RendaController::class, 'destroy']);


//Routes dispesas~

Route::prefix('despesas')->group(function () {
    Route::get('/', [DespesaController::class, 'index']);  // Listar todas as despesas
    Route::post('/', [DespesaController::class, 'store']); // Criar uma nova despesa
    Route::get('{id}', [DespesaController::class, 'show']);  // Exibir uma despesa específica
    Route::put('{id}', [DespesaController::class, 'update']); // Atualizar uma despesa
    Route::delete('{id}', [DespesaController::class, 'destroy']); // Deletar uma despesa
});


//Routes servicos



Route::prefix('servicos')->group(function () {
    Route::get('/', [ServicoController::class, 'index']);  // Listar todos os serviços
    Route::post('/', [ServicoController::class, 'store']); // Criar um novo serviço
    Route::get('{id}', [ServicoController::class, 'show']);  // Exibir um serviço específico
    Route::put('{id}', [ServicoController::class, 'update']); // Atualizar um serviço
    Route::delete('{id}', [ServicoController::class, 'destroy']); // Deletar um serviço
});



//Route Fialial

Route::prefix('filiais')->group(function () {
    Route::get('/', [FilialController::class, 'index']);  // Listar todas as filiais
    Route::post('/', [FilialController::class, 'store']); // Criar uma nova filial
    Route::get('{id}', [FilialController::class, 'show']); // Exibir uma filial específica
    Route::put('{id}', [FilialController::class, 'update']); // Atualizar uma filial
    Route::delete('{id}', [FilialController::class, 'destroy']); // Deletar uma filial
});


//Routes Agendamentos

// routes/api.php



// routes/api.php



Route::prefix('agendamentos')->group(function () {
    Route::get('/', [AgendamentoController::class, 'index']);  // Listar todos os agendamentos
    Route::post('/', [AgendamentoController::class, 'store']); // Criar um novo agendamento
    Route::get('{id}', [AgendamentoController::class, 'show']); // Exibir um agendamento específico
    Route::put('{id}', [AgendamentoController::class, 'update']); // Atualizar um agendamento
    Route::delete('{id}', [AgendamentoController::class, 'destroy']); // Deletar um agendamento
});
