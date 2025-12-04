<?php
// src/ArchivoPowerPointWin7.php

require_once __DIR__ . '/Interfaces/ArchivoWin7Interface.php';

class ArchivoPowerPointWin7 implements ArchivoWin7Interface
{
    private string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function abrirEnWin7(): string
    {
        return "Abriendo presentación de PowerPoint (Win7): {$this->nombre}.pptx en Windows 7.";
    }
}
