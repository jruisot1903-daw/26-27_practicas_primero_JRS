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
        "TEXTO" => "Relacion 1",
        "LINK" => "/aplicacion/relacion1/index.php"
    ],
    [
        "TEXTO" => "Ejercicio 3",
        "LINK" => "/aplicacion/relacion1/ejercicio3.php"
    ]
];


$array1 = [];

$array1[1] = "Pepe";
$array1[16] = 123;
$array1[54] = "Ana";
$array1[] = 34;
$array1["uno"]  = "cadena";
$array1["dos"]  = true;
$array1["tres"] = 1.345;
$array1["ultima"] = [1, 34, "nueva"]; // declaramos el array y le vamos añadiendo el valor uno a uno 


$array2 = array(
    1 => "Pepe",
    16 => 123,
    54 => "Ana",
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => array(1, 34, "nueva"),
    34
); // le añadimos el valor al arry con una sola sentencia 


$array3 = [
    1 => "Pepe",
    16 => 123,
    54 => "Ana",
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => [1, 34, "nueva"],
    34
]; // añadiendole el valor al array con una sola sentencia con []

function mostrarArray($arr, $nombre)
{ // le he implementado que a la funcion le pasemos el nombre en este caso es el titutlo de cada array de como esta hecho
    echo "<h3>$nombre</h3>";
    foreach ($arr as $clave => $valor) {
        if (is_array($valor)) { // is_array lo utilizamos para cada dato del array comprobar si es un dato cualquiera o si es otro array
            echo "$clave => [ " . implode(", ", $valor) . " ]<br>";
            // utilizamos implode para pasar el array en una cadena de texto y le ponemos el separador de sus elementos en este caso una ,
        } else {
            echo "$clave => $valor<br>";
        }
    }
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 3 ", $barraUbi);
cuerpo($array1, $array2, $array3); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($ar1, $ar2, $ar3)
{
    mostrarArray($ar1, "Array1 (varias sentencias)");
    mostrarArray($ar2, "Array2 (array())");
    mostrarArray($ar3, "Array3 ([])");
}
