<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\SoftlandMockService; // Importar el componente de servicio

class ClienteController extends Controller
{
    // ... (Mantén tu método index igual)

    // Inyección de dependencias en el método store
    public function store(Request $request, SoftlandMockService $softlandService)
    {
        $validator = Validator::make($request->all(), [
            'rut_empresa' => 'required|string|unique:clientes',
            'rubro' => 'required|string',
            'razon_social' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
            'email_contacto' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cliente = Cliente::create($request->all());
        
        // Consumo de servicio externo simulado de Softland[cite: 1, 2]
        $syncResult = $softlandService->syncCliente($cliente);

        // Agregamos el resultado de la integración a la respuesta JSON
        return response()->json([
            'cliente' => $cliente,
            'softland_sync' => $syncResult
        ], 201); 
    }

    // ... (Mantén los métodos show, update y destroy que ya tenías)
}