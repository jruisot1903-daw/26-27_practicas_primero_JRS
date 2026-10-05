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
        "TEXTO" => "Ejercicio 4",
        "LINK" => "/aplicacion/relacion1/ejercicio4.php"
    ]
];

// Inicializamos las variables 
const filas = 5;
$numeros = [];

// Recorremos el array y lo rellenamos con los números

for ($i = 1; $i <= filas; $i++){
    for ($j = 1; $j <= $i; $j++){
        $numeros[$i][$j] = $i;
    }
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 4 ",$barraUbi);
cuerpo($numeros,filas); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($num,$filas)
{
    echo "<br>";
    foreach($num as $fila){
        foreach($fila as $valor){
            echo$valor. " ";
        }
        echo "<br>";
    }
}
