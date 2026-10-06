
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
        "TEXTO" => "Ejercicio 6",
        "LINK" => "/aplicacion/relacion1/ejercicio6.php"
    ]
];

$vector = array("primera" => 12.56, 24 => true, 67 => 23.76);

$claves = array_keys($vector); // Le metemos el array de claves a $claves
$valores = array_values($vector); // Le metemos el array de valores a $valores

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 6 ",$barraUbi);
cuerpo($vector, $claves, $valores); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($vector, $claves, $valores)
{

    echo "<h1>Simulando bucle foreach</h1>";
    
    // con el array_walk podemos recorrer el array y mostrar sus elementos
    array_walk($vector, function ($valor, $clave) {
        echo "<p>Clave: $clave - Valor: $valor</p>";
    });

    echo "<h1>Claves del array</h1>";
    
    // Hacemos lo mismo con las claves del array
    array_walk($claves, function ($value) {
        echo "<p>Clave: ".$value."</p>";
    });

    echo "<h1>Valor del array</h1>";
    
    // Hacemos lo mismo con los valores del array
    array_walk($valores, function ($value) {
        echo "<p>Valor: ".$value."</p>";
    });
}
