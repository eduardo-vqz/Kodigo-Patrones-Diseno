<?php
// src/Interfaces/ArchivoInterface.php

interface ArchivoInterface
{
    public function getNombre(): string;
    public function getTipo(): string;
    public function abrir(): string;
}
