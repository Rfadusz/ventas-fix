<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ClienteController;

// Rutas Públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas Protegidas por Autenticación (El consumo de API debe tener este método)[cite: 1]
Route::middleware('auth:api')->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('productos', ProductoController::class);
    Route::apiResource('clientes', ClienteController::class);
});