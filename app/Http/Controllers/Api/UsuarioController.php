<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // CRÍTICO: Necesario para el cifrado

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rut' => 'required|string|unique:usuarios',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            // Validación estricta: El email debe ser @ventasfix.cl
            'email' => ['required', 'email', 'unique:usuarios', 'regex:/^[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'],
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        // Cifrado obligatorio de la base de datos[cite: 1, 2]
        $data['password'] = Hash::make($data['password']);

        $usuario = Usuario::create($data);
        return response()->json($usuario, 201); // 201 Created[cite: 2]
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'rut' => 'sometimes|required|string|unique:usuarios,rut,'.$id,
            'nombre' => 'sometimes|required|string',
            'apellido' => 'sometimes|required|string',
            'email' => ['sometimes', 'required', 'email', 'unique:usuarios,email,'.$id, 'regex:/^[a-zA-Z0-9._%+-]+@ventasfix\.cl$/'],
            'password' => 'sometimes|required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        // Cifrar nuevamente si se envía una contraseña actualizada
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $usuario->update($data);
        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $usuario->delete();
        return response()->json(null, 204); // 204 No Content de manera segura y eficiente[cite: 1, 2]
    }
}