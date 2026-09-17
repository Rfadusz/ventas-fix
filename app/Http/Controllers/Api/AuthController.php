<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Controlador de Registro con Cifrado Obligatorio[cite: 1, 2]
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rut' => 'required|string|unique:usuarios',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            // Validación implacable del dominio exigido[cite: 1]
            'email' => ['required','string','email','unique:usuarios','regex:/^[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'],
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $usuario = Usuario::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Cifrado de datos según rúbrica[cite: 2]
        ]);

        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
    }

    // Controlador de Inicio de Sesión[cite: 2]
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}