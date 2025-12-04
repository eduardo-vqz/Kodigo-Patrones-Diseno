<?php
// src/ArmaDecorator.php

require_once __DIR__ . '/Personaje.php';

abstract class ArmaDecorator implements Personaje
{
    protected Personaje $personaje;

    public function __construct(Personaje $personaje)
    {
        $this->personaje = $personaje;
    }

    public function getNombre(): string
    {
        // Por defecto, no cambia el nombre del personaje
        return $this->personaje->getNombre();
    }

    public function getDescripcion(): string
    {
        // Se completará en los decoradores concretos
        return $this->personaje->getDescripcion();
    }

    public function getAtaque(): int
    {
        // Se completará en los decoradores concretos
        return $this->personaje->getAtaque();
    }
}
