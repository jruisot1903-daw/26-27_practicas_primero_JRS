<?php
// scripts/funciones/puntos.php
// Funciones comunes para trabajar con los puntos (usables desde index.php, imagen.php, etc.)
// Requiere que la clase Punto ya esté cargada.

/**
 * Convierte una línea "x ; y ; color ; grosor" en un objeto Punto.
 * Devuelve null si la línea no es válida.
 */
function lineaAPunto(string $linea, int $max = 500): ?Punto
{
    $partes = array_map('trim', explode(';', $linea));
    if (count($partes) !== 4) {
        return null;
    }

    $x = filter_var($partes[0], FILTER_VALIDATE_INT);
    $y = filter_var($partes[1], FILTER_VALIDATE_INT);
    $g = filter_var($partes[3], FILTER_VALIDATE_INT);

    if ($x === false || $y === false || $g === false) {
        return null;
    }
    if ($x < 0 || $x > $max || $y < 0 || $y > $max) {
        return null;
    }

    try {
        return new Punto($x, $y, $partes[2], $g);
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Lee el fichero .dat y devuelve el array de puntos (ignora líneas inválidas).
 */
function cargarPuntos(string $fichero): array
{
    $puntos = [];
    if (!file_exists($fichero)) {
        return $puntos;
    }

    $lineas = file($fichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $p = lineaAPunto($linea);
        if ($p !== null) {
            $puntos[] = $p;
        }
    }
    return $puntos;
}

/**
 * Guarda todos los puntos en el fichero .dat (una línea por punto).
 */
function guardarPuntos(array $puntos, string $fichero): void
{
    $contenido = "";
    foreach ($puntos as $p) {
        $contenido .= $p->__toString() . "\n";
    }
    file_put_contents($fichero, $contenido);
}

/**
 * Cadena que identifica al cliente: IP (con _ en lugar de . o :) + navegador.
 * Ej: 192_168_2_101_chrome
 */
function nombreCliente(): string
{
    $ip     = str_replace(['.', ':'], '_', $_SERVER['REMOTE_ADDR'] ?? 'desconocida');
    $agente = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // El orden importa: Edge y Opera también contienen "Chrome" en su user agent
    if (stripos($agente, 'edg') !== false)         $navegador = 'edge';
    elseif (stripos($agente, 'opr') !== false)     $navegador = 'opera';
    elseif (stripos($agente, 'chrome') !== false)  $navegador = 'chrome';
    elseif (stripos($agente, 'firefox') !== false) $navegador = 'firefox';
    elseif (stripos($agente, 'safari') !== false)  $navegador = 'safari';
    else                                           $navegador = 'otro';

    return $ip . '_' . $navegador;
}

/** Nombre del fichero de puntos: puntos_dirip_navegador.dat */
function obtenerNombreFichero(): string
{
    return "puntos_" . nombreCliente() . ".dat";
}

/** Nombre de la imagen: imagen_dirip_navegador.jpg */
function obtenerNombreImagen(): string
{
    return "imagen_" . nombreCliente() . ".jpg";
}

/**
 * Dibuja los puntos en un lienzo GD (fondo blanco con marco negro) y lo devuelve.
 */
function dibujarImagen(array $puntos, int $ancho = 500, int $alto = 500)
{
    $img = imagecreatetruecolor($ancho, $alto);

    $blanco = imagecolorallocate($img, 255, 255, 255);
    $negro  = imagecolorallocate($img, 0, 0, 0);

    imagefill($img, 0, 0, $blanco);
    imagerectangle($img, 0, 0, $ancho - 1, $alto - 1, $negro);

    foreach ($puntos as $p) {
        [$r, $g, $b] = Punto::COLORES[$p->getColor()]['rgb'];
        $color    = imagecolorallocate($img, $r, $g, $b);
        $diametro = $p->getGrosor() * 4;

        imagefilledellipse($img, $p->getX(), $p->getY(), $diametro, $diametro, $color);
    }

    return $img;
}

/**
 * Crea la imagen con los puntos y la guarda como JPG en $ruta.
 */
function crearImagen(array $puntos, string $ruta): void
{
    $carpeta = dirname($ruta);
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0775, true);
    }

    $img = dibujarImagen($puntos);
    imagejpeg($img, $ruta);
}
