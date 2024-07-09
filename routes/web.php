<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordenacaoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\CompetenciaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AvaliacaoServidorController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();



// Route::get('/', function () {
//     return view('painel.painel');
// })->name('painel');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ROTA ADMIN
    Route::get('/painel', function () {
        return view('painel.painel');
    })->name('painel');
    // ROTA ADMIN

    // ROTA PARA AVALIAÇÃO
    Route::get('/avaliacaoServidor/{id}', [AvaliacaoServidorController::class, 'carregaAvaliacao'])->name('avaliacao_servidor.avaliacao');

    // ROTAS DE COORDENACAO
    Route::prefix('coordenacoes')->group(function () {
        Route::get('/', [CoordenacaoController::class, 'index'])->name('coordenacoes.index');
        Route::get('/create', [CoordenacaoController::class, 'create'])->name('coordenacoes.create');
        Route::post('/', [CoordenacaoController::class, 'store'])->name('coordenacoes.store');
        Route::get('/{coordenacao}', [CoordenacaoController::class, 'show'])->name('coordenacoes.show');
        Route::get('/{coordenacao}/edit', [CoordenacaoController::class, 'edit'])->name('coordenacoes.edit');
        Route::put('/{coordenacao}', [CoordenacaoController::class, 'update'])->name('coordenacoes.update');
        Route::delete('/{coordenacao}', [CoordenacaoController::class, 'destroy'])->name('coordenacoes.destroy');
    });

    // ROTAS DE SERVICO
    Route::prefix('servicos')->group(function () {
        Route::get('/', [ServicoController::class, 'index'])->name('servicos.index');
        Route::get('/create', [ServicoController::class, 'create'])->name('servicos.create');
        Route::post('/', [ServicoController::class, 'store'])->name('servicos.store');
        Route::get('/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
        Route::get('/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
        Route::put('/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
        Route::delete('/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');
    });

    // ROTAS DE SERVIDORES
    Route::prefix('servidores')->group(function () {
        Route::get('/', [ServidorController::class, 'index'])->name('servidores.index');
        Route::get('/create', [ServidorController::class, 'create'])->name('servidores.create');
        Route::post('/', [ServidorController::class, 'store'])->name('servidores.store');
        Route::get('/{servidor}', [ServidorController::class, 'show'])->name('servidores.show');
        Route::get('/{servidor}/edit', [ServidorController::class, 'edit'])->name('servidores.edit');
        Route::put('/{servidor}', [ServidorController::class, 'update'])->name('servidores.update');
        Route::delete('/{servidor}', [ServidorController::class, 'destroy'])->name('servidores.destroy');
    });

    // ROTAS DE AVALIAÇÕES
    Route::prefix('avaliacao')->group(function () {
        Route::get('/', [AvaliacaoController::class, 'index'])->name('avaliacao.index');
        Route::get('/create', [AvaliacaoController::class, 'create'])->name('avaliacao.create');
        Route::post('/', [AvaliacaoController::class, 'store'])->name('avaliacao.store');
        Route::get('/{avaliacao}', [AvaliacaoController::class, 'show'])->name('avaliacao.show');
        Route::get('/{avaliacao}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacao.edit');
        Route::put('/{avaliacao}', [AvaliacaoController::class, 'update'])->name('avaliacao.update');
        Route::delete('/{avaliacao}', [AvaliacaoController::class, 'destroy'])->name('avaliacao.destroy');
        
        Route::post('/avaliacoes/sortear', [AvaliacaoController::class, 'sortear'])->name('avaliacoes.sortear');
    });

    // ROTA PARA PERGUNTA --RESOURCE
    Route::resource('perguntas', PerguntaController::class);

    // ROTA PARA COMPETÊNCIA --RESOURCE
    Route::resource('competencias', CompetenciaController::class);

    // ROTA PARA NOTA --RESOURCE
    Route::resource('notas', NotaController::class);
    
});