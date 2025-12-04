<?php
// src/Estrategias/SalidaStrategy.php

interface SalidaStrategy
{
    /**
     * Ejecuta la salida del mensaje.
     *
     * @param string $mensaje
     * @return string Mensaje descriptivo de la operación realizada.
     */
    public function mostrar(string $mensaje): string;
}
