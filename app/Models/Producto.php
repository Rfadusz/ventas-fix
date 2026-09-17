<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    
    // Autorización estricta de asignación masiva
    protected $fillable = [
        'sku', 
        'nombre', 
        'descripcion_corta', 
        'descripcion_larga', 
        'imagen', 
        'precio_neto', 
        'precio_venta', 
        'stock_actual', 
        'stock_minimo', 
        'stock_bajo', 
        'stock_alto'
    ];
}