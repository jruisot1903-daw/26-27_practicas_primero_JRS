<?php
// Genera AL VUELO el JPG con los puntos actuales y lo descarga.
// Este fichero no debe imprimir nada más (ni HTML, ni espacios).

include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(RUTABASE . "/scripts/funciones/puntos.php");

// Cargamos los puntos del .dat de este cliente (el mismo que usa index.php)
$fichero = __DIR__ . "/datos/" . obtenerNombreFichero();
$puntos  = cargarPuntos($fichero);

// Creamos la imagen en memoria con GD
$img = dibujarImagen($puntos);

// Descartamos cualquier salida previa para no estropear la imagen
if (ob_get_length()) {
    ob_clean();
}

$nombreDescarga = "puntos_" . date("Ymd_His") . ".jpg";

header("Content-Type: image/jpeg");
header("Content-Disposition: attachment; filename=\"$nombreDescarga\"");

imagejpeg($img);
exit;