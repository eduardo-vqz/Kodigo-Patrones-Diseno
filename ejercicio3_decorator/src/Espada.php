<?php
// src/Espada.php

require_once __DIR__ . '/ArmaDecorator.php';

class Espada extends ArmaDecorator
{
    public function getDescripcion(): string
    {
        return $this->personaje->getDescripcion() . ' + Espada de acero afilada.';
    }

    public function getAtaque(): int
    {
        // La espada aumenta el ataque en 5 puntos
        return $this->personaje->getAtaque() + 5;
    }
}
