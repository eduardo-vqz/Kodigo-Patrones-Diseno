<?php
// Zombi.php

require_once 'Personaje.php';

class Zombi implements Personaje
{
    public function atacar(): string
    {
        return "El Zombi realiza un ataque cuerpo a cuerpo con mordidas.";
    }

    public function obtenerVelocidad(): int
    {
        // Menos velocidad, pero puede interpretarse como más daño o más resistencia
        return 1;
    }
}
