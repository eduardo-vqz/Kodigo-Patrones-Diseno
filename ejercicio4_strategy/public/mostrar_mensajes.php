<?php
// public/mostrar_mensajes.php

require_once __DIR__ . '/../src/Mensaje.php';
require_once __DIR__ . '/../src/Estrategias/SalidaConsola.php';
require_once __DIR__ . '/../src/Estrategias/SalidaJSON.php';
require_once __DIR__ . '/../src/Estrategias/SalidaTXT.php';

$mensajeIngresado = $_POST['mensaje'] ?? null;
$resultados = [];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($mensajeIngresado === null || trim($mensajeIngresado) === '') {
            throw new InvalidArgumentException("Debe ingresar un mensaje.");
        }

        $mensaje = new Mensaje();

        // 1. Estrategia consola
        $mensaje->setStrategy(new SalidaConsola());
        $resultados['consola'] = $mensaje->procesar($mensajeIngresado);

        // 2. Estrategia JSON
        $mensaje->setStrategy(new SalidaJSON());
        $resultados['json'] = $mensaje->procesar($mensajeIngresado);

        // 3. Estrategia TXT (se guarda archivo en ../salidas)
        $directorioSalidas = __DIR__ . '/../salidas';
        $mensaje->setStrategy(new SalidaTXT($directorioSalidas));
        $resultados['txt'] = $mensaje->procesar($mensajeIngresado);

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Patrón Strategy</title>
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
                Patrones de Diseño en PHP - Strategy
            </span>
        </div>
    </nav>

    <div class="container">
        <!-- Formulario -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ejercicio 4: Mensajes con diferentes tipos de salida</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Ingrese un mensaje y el sistema lo mostrará utilizando distintas
                            <strong>estrategias de salida</strong>: consola, JSON y archivo TXT,
                            aplicando el <strong>patrón de diseño Strategy</strong>.
                        </p>

                        <form method="post" class="row g-3">
                            <div class="col-12">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea 
                                    name="mensaje" 
                                    id="mensaje" 
                                    class="form-control" 
                                    rows="3"
                                    required
                                ><?= htmlspecialchars($mensajeIngresado ?? '') ?></textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Procesar mensaje
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

        <!-- Resultados -->
        <?php if (!empty($resultados) && !$error): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <!-- Consola -->
                    <div class="card shadow-sm mb-3">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0">Salida por consola</h6>
                        </div>
                        <div class="card-body">
                            <pre class="mb-0" style="white-space: pre-wrap;">
<?= htmlspecialchars($resultados['consola']) ?>
                            </pre>
                        </div>
                    </div>

                    <!-- JSON -->
                    <div class="card shadow-sm mb-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Salida en formato JSON</h6>
                        </div>
                        <div class="card-body">
                            <pre class="mb-0" style="white-space: pre-wrap;">
<?= htmlspecialchars($resultados['json']) ?>
                            </pre>
                        </div>
                    </div>

                    <!-- TXT -->
                    <div class="card shadow-sm mb-3">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">Salida en archivo TXT</h6>
                        </div>
                        <div class="card-body">
                            <pre class="mb-0" style="white-space: pre-wrap;">
<?= htmlspecialchars($resultados['txt']) ?>
                            </pre>
                            <small class="text-muted">
                                Nota: El archivo TXT se ha creado en la carpeta 
                                <code>salidas</code> dentro del ejercicio.
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center text-muted">
                <small>
                    Este ejemplo aplica el patrón <strong>Strategy</strong>: cada tipo de salida 
                    (consola, JSON, TXT) es una <em>estrategia</em> intercambiable 
                    que se utiliza desde la clase <code>Mensaje</code>.
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
