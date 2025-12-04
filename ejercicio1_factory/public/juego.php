<?php
// public/juego.php

require_once __DIR__ . '/../src/PersonajeFactory.php';

$nivelSeleccionado = $_GET['nivel'] ?? null;
$resultado = null;
$error = null;

if ($nivelSeleccionado !== null) {
    try {
        $personaje = PersonajeFactory::crearPersonaje($nivelSeleccionado);

        $resultado = [
            'nivel' => $nivelSeleccionado,
            'tipoPersonaje' => get_class($personaje),
            'ataque' => $personaje->atacar(),
            'velocidad' => $personaje->obtenerVelocidad()
        ];
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Patrón Factory</title>
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
            <span class="navbar-brand mb-0 h1">Patrones de Diseño en PHP - Factory</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ejercicio 1: Selección de personaje según nivel</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Selecciona el <strong>nivel del juego</strong> y el sistema creará automáticamente
                            el personaje correspondiente usando el <strong>patrón de diseño Factory</strong>.
                        </p>

                        <form method="get" class="row g-3">
                            <div class="col-md-6">
                                <label for="nivel" class="form-label">Nivel del juego</label>
                                <select name="nivel" id="nivel" class="form-select" required>
                                    <option value="" disabled selected>Seleccione un nivel</option>
                                    <option value="facil"   <?= $nivelSeleccionado === 'facil' ? 'selected' : '' ?>>Fácil (Esqueleto)</option>
                                    <option value="dificil" <?= $nivelSeleccionado === 'dificil' ? 'selected' : '' ?>>Difícil (Zombi)</option>
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">
                                    Crear personaje
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($error): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        <strong>Error:</strong> <?= htmlspecialchars($error) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($resultado && !$error): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Personaje creado correctamente</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nivel del juego:</strong> <?= htmlspecialchars($resultado['nivel']) ?></p>
                            <p><strong>Tipo de personaje:</strong> <?= htmlspecialchars($resultado['tipoPersonaje']) ?></p>
                            <p><strong>Ataque:</strong> <?= htmlspecialchars($resultado['ataque']) ?></p>
                            <p><strong>Velocidad:</strong> <?= htmlspecialchars($resultado['velocidad']) ?> unidades</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center text-muted">
                <small>
                    Este ejemplo aplica el patrón <strong>Factory</strong>: la creación del personaje
                    se delega a la clase <code>PersonajeFactory</code>, no al formulario ni a la vista.
                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS  -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
</body>
</html>
