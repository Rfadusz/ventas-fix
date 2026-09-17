<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    // Muestra la vista de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesa el inicio de sesión web
    public function login(Request $request)
    {
        // Validaciones estrictas: no datos vacíos y formato de correo corporativo
        $request->validate([
            'email' => 'required|email|regex:/@ventasfix\.cl$/',
            'password' => 'required|string'
        ]);

        // Buscamos al usuario por su email
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificamos si existe y si la contraseña cifrada coincide[cite: 1, 2]
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Autenticamos manualmente la sesión web
            Auth::login($usuario);
            return redirect()->intended('/dashboard');
        }

        // Si falla, retorna con error
        return back()->withErrors(['email' => 'Las credenciales son incorrectas o el correo no es de Ventas Fix.']);
    }

    // Cierre de sesión seguro
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}