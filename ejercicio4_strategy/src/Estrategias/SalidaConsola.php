<?php
// src/Estrategias/SalidaConsola.php

require_once __DIR__ . '/SalidaStrategy.php';

class SalidaConsola implements SalidaStrategy
{
    public function mostrar(string $mensaje): string
    {
        // Simula mostrar en consola (aquí mostramos en una sección tipo "consola" en la web)
        return "Salida por consola:\n" . $mensaje;
    }
}

