<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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
        "TEXTO" => "Relacion 4",
        "LINK" => ""
    ]
];

//controlador



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 4 ", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    echo "<h1>Clases, Objetos y Enumeraciones</h1>";

    /* Probandolo antes de ser abstracta 
    echo "<h2>Ejercicio1: </h2>";
    echo "<h1>Prueba InstrumentosBase</h1><br>";
    $objt1 = new InstrumentoBase("Maracas",20);
    $objt2 = new InstrumentoBase("Maracas",21);
    
    echo "$objt1";
    echo "$objt2";*/

    echo "<h2>Probando Clase InstumentoViento</h2>";
     $InstrumentoViento = new InstrumentoViento("Metal",20);
     $InstrumentoViento->setDescripcion("payo");
     echo $InstrumentoViento."<br>";
     echo $InstrumentoViento->sonido()."<br>";
     echo $InstrumentoViento->afinar();
     
}
