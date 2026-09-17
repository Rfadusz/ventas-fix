<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    // 2.1 Listar todos los productos
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    // 2.3 Agregar un nuevo producto
    public function store(Request $request)
    {
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
        // REGLA DE NEGOCIO: El precio de venta incluye el 19% de IVA[cite: 1]
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        $producto = Producto::create($data);
        return response()->json($producto, 201); // 201 Created
    }

    // 2.2 Obtener los datos de un producto por su ID[cite: 1]
    public function show($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto, 200);
    }

    // 2.4 Actualizar un producto por su id[cite: 1]
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $data = $request->all();
        // Si actualizan el precio neto, recalculamos el precio de venta con IVA de forma automática
        if (isset($data['precio_neto'])) {
            $data['precio_venta'] = $data['precio_neto'] * 1.19;
        }

        $producto->update($data);
        return response()->json($producto, 200);
    }

    // 2.5 Eliminar un producto por su Id[cite: 1]
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(null, 204); // 204 No Content para eliminación eficiente[cite: 2]
    }
}