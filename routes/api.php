<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ContaController;
use App\Http\Controllers\Api\TransacaoController;
use App\Http\Controllers\Api\OrcamentoController;
use App\Http\Controllers\Api\MetaController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Sem necessidade de Token)
|--------------------------------------------------------------------------
*/
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem enviar Header: Authorization Bearer {token})
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    // Dados do usuário logado e Logout
    Route::get('/usuario', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Recursos da aplicação
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('contas', ContaController::class);
    Route::apiResource('transacoes', TransacaoController::class);
    Route::apiResource('orcamentos', OrcamentoController::class);
    Route::apiResource('metas', MetaController::class);
});