<?php
// src/Estrategias/SalidaTXT.php

require_once __DIR__ . '/SalidaStrategy.php';

class SalidaTXT implements SalidaStrategy
{
    private string $directorioSalidas;

    public function __construct(string $directorioSalidas)
    {
        $this->directorioSalidas = rtrim($directorioSalidas, DIRECTORY_SEPARATOR);

        if (!is_dir($this->directorioSalidas)) {
            // Crear directorio si no existe
            mkdir($this->directorioSalidas, 0777, true);
        }
    }

    public function mostrar(string $mensaje): string
    {
        $nombreArchivo = 'mensaje_' . date('Ymd_His') . '.txt';
        $rutaCompleta = $this->directorioSalidas . DIRECTORY_SEPARATOR . $nombreArchivo;

        $contenido = "Mensaje guardado en TXT:\n" . $mensaje . "\nFecha: " . date('Y-m-d H:i:s');

        file_put_contents($rutaCompleta, $contenido);

        return "Salida en archivo TXT:\nSe ha guardado el mensaje en el archivo: {$nombreArchivo}";
    }
}
