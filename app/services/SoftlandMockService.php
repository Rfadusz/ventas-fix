<?php

namespace App\Services;

class SoftlandMockService
{
    /**
     * Simula la sincronización de un cliente empresa con la API de Softland.
     */
    public function syncCliente($datosCliente)
    {
        // Aquí se simula la respuesta de la pasarela o ERP externo
        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Cliente sincronizado con Softland ERP exitosamente.'
        ];
    }
}