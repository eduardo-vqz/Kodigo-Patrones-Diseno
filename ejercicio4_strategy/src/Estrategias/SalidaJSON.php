<?php
// src/Estrategias/SalidaJSON.php

require_once __DIR__ . '/SalidaStrategy.php';

class SalidaJSON implements SalidaStrategy
{
    public function mostrar(string $mensaje): string
    {
        $data = [
            'tipo' => 'json',
            'mensaje' => $mensaje,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        return "Salida en formato JSON:\n" . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
