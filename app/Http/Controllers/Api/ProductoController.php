<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    // Lógica para listar todos los registros[cite: 1]
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    // LÓGICA MAESTRA PARA INSERTAR (POST)[cite: 1]
    public function store(Request $request)
    {
        // 1. Validación estricta: Ningún dato vacío permitido[cite: 1]
        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|unique:productos',
            'nombre' => 'required|string',
            'descripcion_corta' => 'required|string',
            'descripcion_larga' => 'required|string',
            'imagen' => 'required|string',
            'precio_neto' => 'required|numeric',
            'stock_actual' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_bajo' => 'required|integer',
            'stock_alto' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        
        // 2. Regla de Negocio: Cálculo automático del precio con 19% de IVA[cite: 1]
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        // 3. Inserción en la base de datos utilizando el modelo
        $producto = Producto::create($data);
        
        // 4. Respuesta HTTP correcta para inserción[cite: 2]
        return response()->json($producto, 201); 
    }

    // Lógica para buscar por ID[cite: 1]
    public function show($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto, 200);
    }

    // Lógica para actualizar[cite: 1]
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'sku' => 'sometimes|required|string|unique:productos,sku,'.$id,
            'nombre' => 'sometimes|required|string',
            'descripcion_corta' => 'sometimes|required|string',
            'descripcion_larga' => 'sometimes|required|string',
            'imagen' => 'sometimes|required|string',
            'precio_neto' => 'sometimes|required|numeric',
            'stock_actual' => 'sometimes|required|integer',
            'stock_minimo' => 'sometimes|required|integer',
            'stock_bajo' => 'sometimes|required|integer',
            'stock_alto' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        if(isset($data['precio_neto'])){
            $data['precio_venta'] = $data['precio_neto'] * 1.19; // Mantener impuesto[cite: 1]
        }

        $producto->update($data);
        return response()->json($producto, 200);
    }

    // Lógica para eliminar de forma segura[cite: 1]
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        
        // Respuesta eficiente sin contenido HTTP 204[cite: 2]
        return response()->json(null, 204); 
    }
}