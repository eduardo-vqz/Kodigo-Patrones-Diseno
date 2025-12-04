<?php
// src/AdaptadorWin7aWin10.php

require_once __DIR__ . '/Interfaces/ArchivoInterface.php';
require_once __DIR__ . '/Interfaces/ArchivoWin7Interface.php';

class AdaptadorWin7aWin10 implements ArchivoInterface
{
    private ArchivoWin7Interface $archivoWin7;
    private string $nombre;
    private string $tipo;

    public function __construct(ArchivoWin7Interface $archivoWin7, string $nombre, string $tipo)
    {
        $this->archivoWin7 = $archivoWin7;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function abrir(): string
    {
        // Aquí se simula el proceso de compatibilidad/conversión
        $mensajeCompatibilidad = "Convirtiendo archivo {$this->nombre} ({$this->tipo}) "
            . "desde formato Windows 7 para que sea compatible con Windows 10...";

        $mensajeOriginal = $this->archivoWin7->abrirEnWin7();

        return $mensajeCompatibilidad . PHP_EOL . $mensajeOriginal;
    }
}
