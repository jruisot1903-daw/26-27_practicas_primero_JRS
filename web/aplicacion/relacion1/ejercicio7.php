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
        "TEXTO" => "Ejercicio 7",
        "LINK" => "/aplicacion/relacion1/ejercicio7.php"
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 7 ",$barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    
      $fecha = new DateTime();

    echo "<h3>Fecha Actual formato 'd/m/Y'</h3>";
    echo $fecha -> format("d/m/Y");

     echo "<h3>Fecha Actual formato 'dia d, mes mmmm, año yyyy, dia de la semana dd'</h3>";
     echo $fecha -> format("d-m-Y, l");

     echo "<h3>Fecha Actual formato 'hh:mm:ss'</h3>";
     echo $fecha -> format("h:i:s");

     echo "<h3>Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45</h3>";
     $fechaFija = DateTime::createFromFormat('d/m/Y H:i', '29/3/2024 12:45');
     echo $fechaFija->format("d/m/Y") . "<br>";
     echo $fechaFija->format("d-m-Y, l") . "<br>";
     echo $fechaFija->format("H:i:s") . "<br>";

     echo "<h3>Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas</h3>";
     $fechaMenos = $fecha;
     $fechaMenos-> modify('-12 days -4 hours');
     echo $fechaMenos -> format("d/m/Y") . "<br>";
     echo $fechaMenos -> format("d-m-Y, l") . "<br>";
     echo $fechaMenos -> format("H:i:s") . "<br>";
}
