<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Método que gestiona el Dashboard web y los contadores obligatorios[cite: 1]
    public function index()
    {
        $totalUsuarios = Usuario::count();   // Conteo de usuarios[cite: 1]
        $totalProductos = Producto::count(); // Conteo de productos[cite: 1]
        $totalClientes = Cliente::count();   // Conteo de clientes[cite: 1]

        // Retorna la vista del template integrada en Laravel con los datos
        return view('dashboard', compact('totalUsuarios', 'totalProductos', 'totalClientes'));
    }
}