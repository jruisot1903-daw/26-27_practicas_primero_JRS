<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // para mostrar mensajes tras redirigir
}

// cabecera.php define RUTABASE, el autoload de clases (Punto) e incluye validacion.php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(RUTABASE . "/scripts/funciones/puntos.php");

// CONTROLADOR

// Carpeta de datos (se crea si no existe)
$carpetaDatos = __DIR__ . "/datos";
if (!is_dir($carpetaDatos)) {
    mkdir($carpetaDatos, 0775, true);
}

// Rutas del fichero .dat y de la imagen
$fichero     = $carpetaDatos . "/" . obtenerNombreFichero();
$nombreImg   = obtenerNombreImagen();
$rutaImagen  = RUTABASE . "/imagenes/puntos/" . $nombreImg;
$rutaWeb     = "/imagenes/puntos/" . $nombreImg;

// Lo primero: cargar los puntos del fichero
$puntos = cargarPuntos($fichero);

// Variables iniciales
$errores = [];
$datos   = ['x' => '', 'y' => '', 'color' => '', 'grosor' => ''];

// Mensaje guardado tras una redirección (se muestra una sola vez)
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);

// Al conectarse, si la imagen no existe se crea (solo fondo y marco si no hay puntos)
if (!file_exists($rutaImagen)) {
    crearImagen($puntos, $rutaImagen);
}

// ---------- 1. GUARDAR PUNTO ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
    $datos['x']      = trim($_POST['x'] ?? '');
    $datos['y']      = trim($_POST['y'] ?? '');
    $datos['color']  = $_POST['color'] ?? '';
    $datos['grosor'] = $_POST['grosor'] ?? '';

    // filter_var devuelve false si no es un entero (el 0 es válido, por eso se compara con ===)
    $xInt      = filter_var($datos['x'], FILTER_VALIDATE_INT);
    $yInt      = filter_var($datos['y'], FILTER_VALIDATE_INT);
    $grosorInt = filter_var($datos['grosor'], FILTER_VALIDATE_INT);

    if ($xInt === false || !validaEntero($xInt, 0, 500, 0)) {
        $errores['x'] = "Debe ser un entero entre 0 y 500";
    }
    if ($yInt === false || !validaEntero($yInt, 0, 500, 0)) {
        $errores['y'] = "Debe ser un entero entre 0 y 500";
    }
    if ($datos['color'] === '') {
        $errores['color'] = "Selecciona un color";
    } elseif (!validaRango($datos['color'], Punto::COLORES, 2)) {
        $errores['color'] = "Color no válido";
    }
    if ($grosorInt === false || !validaRango($grosorInt, Punto::GROSORES, 2)) {
        $errores['grosor'] = "Selecciona un grosor válido";
    }

    if (empty($errores)) {
        try {
            $puntos[] = new Punto($xInt, $yInt, $datos['color'], $grosorInt);
            guardarPuntos($puntos, $fichero);
            crearImagen($puntos, $rutaImagen);

            $_SESSION['mensaje'] = "Punto guardado correctamente";
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
    }
}

// ---------- 4. BORRAR PUNTO ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    $indice = filter_var($_POST['puntoSeleccionado'] ?? null, FILTER_VALIDATE_INT);

    if ($indice !== false && isset($puntos[$indice])) {
        unset($puntos[$indice]);
        $puntos = array_values($puntos); // reindexamos para no dejar huecos

        guardarPuntos($puntos, $fichero);
        crearImagen($puntos, $rutaImagen);

        $_SESSION['mensaje'] = "Punto borrado correctamente";
    } else {
        $_SESSION['mensaje'] = "No hay ningún punto seleccionado para borrar";
    }
    header("Location: index.php");
    exit;
}

// ---------- 6. SUBIR FICHERO DE PUNTOS ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subir'])) {
    if (isset($_FILES['ficheroTxt']) && $_FILES['ficheroTxt']['error'] === UPLOAD_ERR_OK) {
        $extension = strtolower(pathinfo($_FILES['ficheroTxt']['name'], PATHINFO_EXTENSION));

        if ($extension !== 'txt') {
            $mensaje = "Solo se permiten ficheros .txt";
        } else {
            $lineas = file($_FILES['ficheroTxt']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $anadidos   = 0;
            $descartados = 0;
            foreach ($lineas as $linea) {
                $p = lineaAPunto($linea);
                if ($p !== null) {
                    $puntos[] = $p;
                    $anadidos++;
                } else {
                    $descartados++;
                }
            }

            guardarPuntos($puntos, $fichero);
            crearImagen($puntos, $rutaImagen);

            $_SESSION['mensaje'] = "Fichero procesado: $anadidos puntos añadidos, $descartados líneas descartadas";
            header("Location: index.php");
            exit;
        }
    } else {
        $mensaje = "Error al subir el fichero";
    }
}

// VISTA

inicioCabecera("Relacion 7");
cabecera();
finCabecera();

inicioCuerpo("Relaciones de Ejercicios");
cuerpo($errores, $mensaje, $puntos, $datos, $rutaWeb, $rutaImagen);
finCuerpo();

function cabecera() {}

function cuerpo(array $errores = [], string $mensaje = '', array $puntos = [], array $datos = [], string $rutaWeb = '', string $rutaImagen = '')
{
    // Evita que el navegador muestre una imagen antigua en caché
    $version = file_exists($rutaImagen) ? filemtime($rutaImagen) : time();
?>
    <?php if ($mensaje !== '') { ?>
        <p><strong><?= htmlspecialchars($mensaje) ?></strong></p>
    <?php } ?>

    <form action="index.php" method="post">
        <label for="x">Coordenada x:</label>
        <input type="number" name="x" id="x" value="<?= htmlspecialchars($datos['x'] ?? '') ?>">
        <span style="color:red"><?= $errores['x'] ?? '' ?></span>

        <label for="y">Coordenada y:</label>
        <input type="number" name="y" id="y" value="<?= htmlspecialchars($datos['y'] ?? '') ?>">
        <span style="color:red"><?= $errores['y'] ?? '' ?></span>

        <label for="color">Color:</label>
        <select name="color" id="color">
            <option value="">-- Elige un color --</option>
            <?php foreach (Punto::COLORES as $clave => $info) { ?>
                <option value="<?= $clave ?>" <?= (($datos['color'] ?? '') === $clave) ? 'selected' : '' ?>>
                    <?= $info['nombre'] ?>
                </option>
            <?php } ?>
        </select>
        <span style="color:red"><?= $errores['color'] ?? '' ?></span>

        <fieldset>
            <legend>Grosor:</legend>
            <?php foreach (Punto::GROSORES as $clave => $nombre) { ?>
                <label>
                    <input type="radio" name="grosor" value="<?= $clave ?>" <?= ((string)($datos['grosor'] ?? '') === (string)$clave) ? 'checked' : '' ?>>
                    <?= $nombre ?>
                </label>
            <?php } ?>
            <span style="color:red"><?= $errores['grosor'] ?? '' ?></span>
        </fieldset>

        <button type="submit" name="guardar">Guardar</button>
    </form>

    <p><a href="imagen.php">Descargar imagen</a></p>

    <h3>Puntos actuales:</h3>
    <textarea rows="10" cols="50" readonly><?php foreach ($puntos as $p) echo $p->__toString() . "\n"; ?></textarea>

    <h3>Imagen creada</h3>
    <img src="<?= $rutaWeb ?>?v=<?= $version ?>" alt="Imagen de puntos" id="imagenPuntos">
    <br>

    <h3>Borrar Puntos</h3>
    <form action="index.php" method="post">
        <select name="puntoSeleccionado" id="puntos">
            <?php foreach ($puntos as $i => $p) { ?>
                <option value="<?= $i ?>">
                    <?= $p->__toString() ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit" name="borrar">Borrar</button>
    </form>

    <h3>Subir fichero de puntos</h3>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="ficheroTxt" accept=".txt">
        <button type="submit" name="subir">Subir fichero</button>
    </form>

<?php
}