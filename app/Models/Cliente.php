<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    
    // Autorización estricta de asignación masiva para clientes empresa[cite: 1]
    protected $fillable = [
        'rut_empresa', 
        'rubro', 
        'razon_social', 
        'telefono', 
        'direccion', 
        'nombre_contacto', 
        'email_contacto'
    ];
}