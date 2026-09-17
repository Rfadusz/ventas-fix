<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Services\SoftlandMockService; // Asegúrate de importar el servicio
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        return response()->json(Cliente::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rut_empresa' => 'required|string|unique:clientes',
            'rubro' => 'required|string',
            'razon_social' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
            'email_contacto' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear el cliente en la Base de Datos local
        $cliente = Cliente::create($request->all());

        // Instanciación directa del servicio Softland Mock
        $softlandService = new SoftlandMockService();
        $syncSoftland = $softlandService->syncCliente($cliente);

        // Retornar respuesta unificada
        return response()->json([
            'mensaje' => 'Cliente registrado con éxito en VentasFix',
            'cliente' => $cliente,
            'integracion_softland' => $syncSoftland
        ], 201);
    }
}