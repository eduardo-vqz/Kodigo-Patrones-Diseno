<?php
// src/Personaje.php

interface Personaje
{
    public function getNombre(): string;
    public function getDescripcion(): string;
    public function getAtaque(): int;
}
