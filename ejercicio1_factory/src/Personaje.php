<?php
// Personaje.php

interface Personaje
{
    public function atacar(): string;
    public function obtenerVelocidad(): int;
}
