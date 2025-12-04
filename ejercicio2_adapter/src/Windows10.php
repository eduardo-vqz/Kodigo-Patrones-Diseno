<?php
// src/Windows10.php

require_once __DIR__ . '/Interfaces/ArchivoInterface.php';

class Windows10
{
    public function abrirArchivo(ArchivoInterface $archivo): string
    {
        $cabecera = "Windows 10: intentando abrir el archivo '{$archivo->getNombre()}' "
            . "de tipo '{$archivo->getTipo()}'.";

        $resultado = $archivo->abrir();

        return $cabecera . PHP_EOL . $resultado;
    }
}
