<?php
// src/Escudo.php

require_once __DIR__ . '/ArmaDecorator.php';

class Escudo extends ArmaDecorator
{
    public function getDescripcion(): string
    {
        return $this->personaje->getDescripcion() . ' + Escudo resistente para defensa.';
    }

    public function getAtaque(): int
    {
        // El escudo no aumenta mucho el ataque, pero podría hacerlo ligeramente
        return $this->personaje->getAtaque() + 1;
    }
}
