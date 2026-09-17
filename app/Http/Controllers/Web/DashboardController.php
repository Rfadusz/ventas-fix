<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Requerimiento 4: Dashboard con contadores
    public function index()
    {
        $totalUsuarios = Usuario::count(); // 4.1 Información de usuarios[cite: 1]
        $totalProductos = Producto::count(); // 4.2 Información de productos[cite: 1]
        $totalClientes = Cliente::count(); // 4.3 Información de clientes[cite: 1]

        // Retorna la vista inyectando las variables calculadas
        return view('dashboard', compact('totalUsuarios', 'totalProductos', 'totalClientes'));
    }
}