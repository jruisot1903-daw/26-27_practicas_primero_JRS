<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once("./libreria.php");

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
        "TEXTO" => "Relacion 3",
        "LINK" => ""
    ]
];

// Ejercicio 1
$vector = array(); // el vecto vacio
$numero = 0;

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 3 ", $barraUbi);
cuerpo($vector,$numero); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($vector,$numero)
{
   echo "<h1>Funciones</h1>"; 
   
echo "<h2>Ejercicio 1</h2>";
cuentaVeces($vector,"1osición",7,$numero); //$vector (“1osición”=>7). En numero se de vuelve 1 porque es la primera llamada…
echo "Primera llamada: ".$numero."<br>";
cuentaVeces($vector,"otra",2,$numero);//$vector(“otra”=>2).En numero se devuelve 2 porque es la segunda llamada…
echo "Segunda llamada: ".$numero;
echo "<br><br>";
foreach($vector as $pos => $valor){
    echo "La posicion: ".$pos." tiene el valor: ".$valor."<br>";
}
}