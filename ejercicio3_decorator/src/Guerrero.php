<?php
// src/Guerrero.php

require_once __DIR__ . '/Personaje.php';

class Guerrero implements Personaje
{
    public function getNombre(): string
    {
        return 'Guerrero';
    }

    public function getDescripcion(): string
    {
        return 'Guerrero cuerpo a cuerpo con armadura ligera.';
    }

    public function getAtaque(): int
    {
        return 10; // ataque base
    }
}
