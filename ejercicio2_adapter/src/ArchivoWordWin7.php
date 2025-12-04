<?php
// src/ArchivoWordWin7.php

require_once __DIR__ . '/Interfaces/ArchivoWin7Interface.php';

class ArchivoWordWin7 implements ArchivoWin7Interface
{
    private string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function abrirEnWin7(): string
    {
        return "Abriendo documento de Word (Win7): {$this->nombre}.docx en Windows 7.";
    }
}
