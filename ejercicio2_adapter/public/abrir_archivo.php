<?php
// public/abrir_archivo.php

require_once __DIR__ . '/../src/ArchivoWordWin7.php';
require_once __DIR__ . '/../src/ArchivoExcelWin7.php';
require_once __DIR__ . '/../src/ArchivoPowerPointWin7.php';
require_once __DIR__ . '/../src/AdaptadorWin7aWin10.php';
require_once __DIR__ . '/../src/Windows10.php';

$tipoArchivo = $_GET['tipo_archivo'] ?? null;
$nombreArchivo = $_GET['nombre_archivo'] ?? null;

$resultado = null;
$error = null;

if ($tipoArchivo !== null && $nombreArchivo !== null) {
    try {
        // 1. Crear el archivo en formato Win7 (código legado)
        switch ($tipoArchivo) {
            case 'word':
                $archivoWin7 = new ArchivoWordWin7($nombreArchivo);
                $tipoTexto = 'Word';
                break;
            case 'excel':
                $archivoWin7 = new ArchivoExcelWin7($nombreArchivo);
                $tipoTexto = 'Excel';
                break;
            case 'powerpoint':
                $archivoWin7 = new ArchivoPowerPointWin7($nombreArchivo);
                $tipoTexto = 'PowerPoint';
                break;
            default:
                throw new InvalidArgumentException("Tipo de archivo no soportado.");
        }

        // 2. Adaptar el archivo Win7 a un "archivo moderno" compatible con Windows 10
        $adaptador = new AdaptadorWin7aWin10($archivoWin7, $nombreArchivo, $tipoTexto);

        // 3. Windows 10 usa únicamente la interfaz moderna ArchivoInterface
        $windows10 = new Windows10();
        $resultado = $windows10->abrirArchivo($adaptador);

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Patrón Adapter</title>
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
                Patrones de Diseño en PHP - Adapter
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ejercicio 2: Compatibilidad de archivos Win7 en Windows 10</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Simula la apertura de archivos creados en <strong>Windows 7</strong>
                            (Word, Excel, PowerPoint) en un entorno <strong>Windows 10</strong>,
                            utilizando el <strong>patrón de diseño Adapter</strong>.
                        </p>

                        <form method="get" class="row g-3">
                            <div class="col-md-6">
                                <label for="tipo_archivo" class="form-label">Tipo de archivo</label>
                                <select name="tipo_archivo" id="tipo_archivo" class="form-select" required>
                                    <option value="" disabled <?= $tipoArchivo === null ? 'selected' : '' ?>>
                                        Seleccione un tipo de archivo
                                    </option>
                                    <option value="word" <?= $tipoArchivo === 'word' ? 'selected' : '' ?>>Word (Win7)</option>
                                    <option value="excel" <?= $tipoArchivo === 'excel' ? 'selected' : '' ?>>Excel (Win7)</option>
                                    <option value="powerpoint" <?= $tipoArchivo === 'powerpoint' ? 'selected' : '' ?>>PowerPoint (Win7)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="nombre_archivo" class="form-label">Nombre del archivo (sin extensión)</label>
                                <input 
                                    type="text" 
                                    name="nombre_archivo" 
                                    id="nombre_archivo" 
                                    class="form-control" 
                                    placeholder="ej: informe_finanzas"
                                    value="<?= htmlspecialchars($nombreArchivo ?? '') ?>"
                                    required
                                >
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    Abrir en Windows 10
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
                            <h5 class="mb-0">Resultado de la apertura del archivo</h5>
                        </div>
                        <div class="card-body">
                            <pre class="mb-0" style="white-space: pre-wrap;"><?= htmlspecialchars($resultado) ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center text-muted">
                <small>
                    Este ejemplo aplica el patrón <strong>Adapter</strong>: Windows 10 solo conoce 
                    la interfaz <code>ArchivoInterface</code>, y el adaptador <code>AdaptadorWin7aWin10</code> 
                    traduce las llamadas hacia los objetos de tipo <code>ArchivoWin7Interface</code>.
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
