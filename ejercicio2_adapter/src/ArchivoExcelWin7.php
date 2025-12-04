<?php
// src/ArchivoExcelWin7.php

require_once __DIR__ . '/Interfaces/ArchivoWin7Interface.php';

class ArchivoExcelWin7 implements ArchivoWin7Interface
{
    private string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function abrirEnWin7(): string
    {
        return "Abriendo hoja de Excel (Win7): {$this->nombre}.xlsx en Windows 7.";
    }
}
