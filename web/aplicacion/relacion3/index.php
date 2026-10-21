<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once(dirname(__FILE__) . "/libreria.php");

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

// Variables de los ejercicios

$vector = array(); // el vecto vacio
$numero = 0;
$result = "";
$valor = 7;
$devuelve = 0;

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 3 ", $barraUbi);
cuerpo($vector, $numero, $result,$valor,$devuelve); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($vector, $numero, $result,$valor,$devuelve)
{
    echo "<h1>Funciones</h1>";

    echo "<h2>Ejercicio 1</h2>";
    cuentaVeces($vector, "1osición", 7, $numero); //$vector (“1osición”=>7). En numero se de vuelve 1 porque es la primera llamada…
    echo "Primera llamada: " . $numero . "<br>";
    cuentaVeces($vector, "otra", 2, $numero); //$vector(“otra”=>2).En numero se devuelve 2 porque es la segunda llamada…
    echo "Segunda llamada: " . $numero;
    echo "<br><br>";
    foreach ($vector as $pos => $valor) {
        echo "La posicion: " . $pos . " tiene el valor: " . $valor . "<br>";
    }
    echo "<hr>";
    echo "<h2>Ejercicio 2</h2>";

    $result = generarCadena(7);

    if ($result === false) {
        echo "Error: Fallo con la longitud de la cadena , no se admite (0 o num negativos)";
    } else {
        echo "La cadena es: " . $result;
    }

    echo "<hr>";
    echo "<h2>Ejercicio 3</h2>";
    echo "Solución de la suma Operaciones(1,2,5,7,3,4): ".Operaciones(1,2,5,7,3,4)."<br>";
    echo "Solución suma los pares y resta impares Operaciones(5,2,5,7,3,4): ".Operaciones(5,2,5,7,3,4);

    echo "<hr>";
    echo "<h2>Ejercicio 4</h2>";
    $devuelve = devuelve($valor,4,2);
    echo "Valor introducciendo los 3 num (\$valor,4,2): ".$devuelve."<br>";
    $devuelve = devuelve($valor);
    echo "Valor introducciendo solo el primer parametro (\$valor): ".$devuelve."<br>";
    $devuelve = devuelve($valor,3);
    echo "Valor introducciendo el primer y el segundo numero (\$valor,3): ".$devuelve."<br>";
    $devuelve = devuelve(num: $valor,num3: 6);
    echo "Valor introduciendo el primero y el tercero numero (num:\$valor,num3: 6): ".$devuelve;

    echo "<hr>";
    echo "<h2>Ejercicio 5</h2>";
}
