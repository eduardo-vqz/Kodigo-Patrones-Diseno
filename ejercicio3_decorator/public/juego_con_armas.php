<?php
// public/juego_con_armas.php

require_once __DIR__ . '/../src/Guerrero.php';
require_once __DIR__ . '/../src/Mago.php';
require_once __DIR__ . '/../src/Espada.php';
require_once __DIR__ . '/../src/Arco.php';
require_once __DIR__ . '/../src/Escudo.php';

$personajeSeleccionado = $_POST['personaje'] ?? null;
$armasSeleccionadas = $_POST['armas'] ?? [];

$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($personajeSeleccionado === null) {
            throw new InvalidArgumentException("Debe seleccionar un personaje.");
        }

        // 1. Crear personaje base
        switch ($personajeSeleccionado) {
            case 'guerrero':
                $personaje = new Guerrero();
                break;
            case 'mago':
                $personaje = new Mago();
                break;
            default:
                throw new InvalidArgumentException("Personaje no soportado.");
        }

        // 2. Aplicar decoradores (armas) uno encima de otro
        //    El orden de las armas afecta la descripción final, pero no es crítico aquí.
        foreach ($armasSeleccionadas as $arma) {
            switch ($arma) {
                case 'espada':
                    $personaje = new Espada($personaje);
                    break;
                case 'arco':
                    $personaje = new Arco($personaje);
                    break;
                case 'escudo':
                    $personaje = new Escudo($personaje);
                    break;
            }
        }

        // 3. Construir resultado final
        $resultado = [
            'nombre' => $personaje->getNombre(),
            'descripcion' => $personaje->getDescripcion(),
            'ataque' => $personaje->getAtaque(),
            'armas' => $armasSeleccionadas
        ];

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Patrón Decorator</title>
    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous"
    >
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                Patrones de Diseño en PHP - Decorator
            </span>
        </div>
    </nav>

    <div class="container">
        <!-- Formulario -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ejercicio 3: Personajes con armas (Decorator)</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Selecciona un <strong>personaje base</strong> y añade
                            <strong>diferentes armas</strong>. Cada arma se agrega usando
                            el <strong>patrón de diseño Decorator</strong>, modificando el
                            comportamiento del personaje sin alterar su clase original.
                        </p>

                        <form method="post" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Personaje</label>
                                <select name="personaje" class="form-select" required>
                                    <option value="" disabled <?= $personajeSeleccionado === null ? 'selected' : '' ?>>
                                        Seleccione un personaje
                                    </option>
                                    <option value="guerrero" <?= $personajeSeleccionado === 'guerrero' ? 'selected' : '' ?>>
                                        Guerrero
                                    </option>
                                    <option value="mago" <?= $personajeSeleccionado === 'mago' ? 'selected' : '' ?>>
                                        Mago
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Armas</label>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="armas[]" 
                                        value="espada" 
                                        id="armaEspada"
                                        <?= in_array('espada', $armasSeleccionadas ?? []) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="armaEspada">
                                        Espada (+5 ataque)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="armas[]" 
                                        value="arco" 
                                        id="armaArco"
                                        <?= in_array('arco', $armasSeleccionadas ?? []) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="armaArco">
                                        Arco (+3 ataque)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="armas[]" 
                                        value="escudo" 
                                        id="armaEscudo"
                                        <?= in_array('escudo', $armasSeleccionadas ?? []) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="armaEscudo">
                                        Escudo (+1 ataque / mayor defensa conceptual)
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Generar personaje equipado
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes de error -->
        <?php if ($error): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        <strong>Error:</strong> <?= htmlspecialchars($error) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Resultado -->
        <?php if ($resultado && !$error): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Personaje generado</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Personaje:</strong> <?= htmlspecialchars($resultado['nombre']) ?></p>
                            <p><strong>Descripción:</strong> <?= htmlspecialchars($resultado['descripcion']) ?></p>
                            <p><strong>Poder de ataque total:</strong> <?= htmlspecialchars($resultado['ataque']) ?></p>

                            <p><strong>Armas equipadas:</strong>
                                <?php if (empty($resultado['armas'])): ?>
                                    Ninguna (solo personaje base).
                                <?php else: ?>
                                    <?= htmlspecialchars(implode(', ', $resultado['armas'])) ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center text-muted">
                <small>
                    Este ejemplo aplica el patrón <strong>Decorator</strong>: cada arma es un 
                    objeto que <em>envuelve</em> al personaje y extiende su comportamiento sin 
                    modificar la clase original del personaje.
                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
</body>
</html>
