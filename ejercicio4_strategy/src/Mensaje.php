<?php
// src/Mensaje.php

require_once __DIR__ . '/Estrategias/SalidaStrategy.php';

class Mensaje
{
    private SalidaStrategy $strategy;

    public function setStrategy(SalidaStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function procesar(string $mensaje): string
    {
        return $this->strategy->mostrar($mensaje);
    }
}
