<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;

// Ruta de bienvenida / Login del Backoffice
Route::get('/', function () {
    return view('login'); // Vista del login del template corporativo
});

// Ruta protegida del Dashboard web[cite: 1]
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');