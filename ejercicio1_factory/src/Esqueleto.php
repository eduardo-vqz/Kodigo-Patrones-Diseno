<?php
// Esqueleto.php

require_once 'Personaje.php';

class Esqueleto implements Personaje
{
    public function atacar(): string
    {
        return "El Esqueleto lanza una flecha ósea desde la distancia.";
    }

    public function obtenerVelocidad(): int
    {
        // Velocidad más alta (nivel fácil: enemigo más predecible y débil)
        return 3;
    }
}
