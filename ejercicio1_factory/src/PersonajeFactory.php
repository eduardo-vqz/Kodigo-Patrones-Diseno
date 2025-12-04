<?php
// PersonajeFactory.php

require_once 'Esqueleto.php';
require_once 'Zombi.php';

class PersonajeFactory
{
    /**
     * Crea un personaje según el nivel del juego.
     *
     * @param string $nivel Valores esperados: 'facil' o 'dificil'
     * @return Personaje
     * @throws InvalidArgumentException
     */
    public static function crearPersonaje(string $nivel): Personaje
    {
        $nivel = strtolower(trim($nivel));

        switch ($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombi();
            default:
                throw new InvalidArgumentException(
                    "Nivel de juego no soportado: $nivel. Use 'facil' o 'dificil'."
                );
        }
    }
}
