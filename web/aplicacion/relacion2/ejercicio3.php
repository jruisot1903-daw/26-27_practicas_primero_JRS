<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

/**
 * Cada elemento es un array de dos posiciones asociativas
 * TEXTO : texto a mostrar en el elemento
 * LINK: Enlace a la pagina
 */

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 2",
        "LINK" => "/aplicacion/relacion2/index.php"
    ],
    [
        "TEXTO" => "Ejercicio 3",
        "LINK" => "/aplicacion/relacion2/ejercicio3.php"
    ]
];

 $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Ejercicio 3 ", $barraUbi);
cuerpo($caracteres_permitidos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($caracteres)
{
     echo "<h3>Palabra aleatoria generada: </h3><br>";
    echo generarCadena($caracteres, 20);
}

function generarCadena($cadenaPer,$lon){
     $longitud_cad = strlen($cadenaPer);
    $cadena_Ale = '';
    for($i = 0; $i < $lon; $i++) {
        $caracter_random = $cadenaPer[mt_rand(0, $longitud_cad - 1)];
        $cadena_Ale .= $caracter_random;
    }
    return $cadena_Ale;
}