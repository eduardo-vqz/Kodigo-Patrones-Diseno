<?php
// src/Arco.php

require_once __DIR__ . '/ArmaDecorator.php';

class Arco extends ArmaDecorator
{
    public function getDescripcion(): string
    {
        return $this->personaje->getDescripcion() . ' + Arco de largo alcance.';
    }

    public function getAtaque(): int
    {
        // El arco aumenta el ataque en 3 puntos
        return $this->personaje->getAtaque() + 3;
    }
}
