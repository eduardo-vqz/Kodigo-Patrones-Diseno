<?php
// src/Mago.php

require_once __DIR__ . '/Personaje.php';

class Mago implements Personaje
{
    public function getNombre(): string
    {
        return 'Mago';
    }

    public function getDescripcion(): string
    {
        return 'Mago especializado en ataques a distancia con magia.';
    }

    public function getAtaque(): int
    {
        return 8; // ataque base
    }
}
