<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;

// Vista principal de inicio de sesión (Debes tener un login.blade.php)
Route::get('/', function () {
    return view('login'); 
});

// Ruta del Dashboard web[cite: 1]
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');