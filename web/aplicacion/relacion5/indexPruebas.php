<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/libreria/val_normal.php");
include_once(dirname(__FILE__) . "/../../scripts/libreria/val_filter.php");

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
        "TEXTO" => "Relacion 5 - Pruebas",
        "LINK" => ""
    ]
];

//controlador


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 5 ", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    echo "<h1>Pruebas de las funciones de validación</h1>";

    // ==========================================
    // VALNORMAL
    // ==========================================

    echo "<h2>Biblioteca VALNORMAL</h2>";

    // validaEntero
    $numero = 25;
    $antes = $numero;
    $resultado = \VALNORMAL\validaEntero($numero, 0, 100, 1);

    echo "<h3>validaEntero</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $numero <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaReal
    $real = 25.75;
    $antes = $real;
    $resultado = \VALNORMAL\validaReal($real, 0, 100, 1.0);

    echo "<h3>validaReal</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $real <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaFecha
    $fecha = "1/2/2023";
    $antes = $fecha;
    $resultado = \VALNORMAL\validaFecha($fecha, "01/01/2000");

    echo "<h3>validaFecha</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $fecha <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaHora
    $hora = "0:5:1";
    $antes = $hora;
    $resultado = \VALNORMAL\validaHora($hora, "00:00:00");

    echo "<h3>validaHora</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $hora <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaEmail
    $email = "usuario@gmail.com";
    $antes = $email;
    $resultado = \VALNORMAL\validaEmail($email, "error@email.com");

    echo "<h3>validaEmail</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $email <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaCadena
    $cadena = "Hola mundo";
    $antes = $cadena;
    $resultado = \VALNORMAL\validaCadena($cadena, 20, "Error");

    echo "<h3>validaCadena</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $cadena <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaExpresion
    $codigo = "ABC123";
    $antes = $codigo;
    $resultado = \VALNORMAL\validaExpresion(
        $codigo,
        "/^[A-Z]{3}[0-9]{3}$/",
        "Error"
    );

    echo "<h3>validaExpresion</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $codigo <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaRango
    $opcion = "rojo";
    $antes = $opcion;
    $colores = ["rojo", "azul", "verde"];
    $resultado = \VALNORMAL\validaRango($opcion, $colores);

    echo "<h3>validaRango</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $opcion <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";


    // ==========================================
    // VALFILTER
    // ==========================================

    echo "<hr>";
    echo "<h2>Biblioteca VALFILTER</h2>";

    // validaEntero
    $numero = 25;
    $antes = $numero;
    $resultado = \VALFILTER\validaEntero($numero, 0, 100, 1);

    echo "<h3>validaEntero</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $numero <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaReal
    $real = 25.75;
    $antes = $real;
    $resultado = \VALFILTER\validaReal($real, 0, 100, 1.0);

    echo "<h3>validaReal</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $real <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaFecha
    $fecha = "1/2/2023";
    $antes = $fecha;
    $resultado = \VALFILTER\validaFecha($fecha, "01/01/2000");

    echo "<h3>validaFecha</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $fecha <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaHora
    $hora = "0:5:1";
    $antes = $hora;
    $resultado = \VALFILTER\validaHora($hora, "00:00:00");

    echo "<h3>validaHora</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $hora <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaEmail
    $email = "usuario@gmail.com";
    $antes = $email;
    $resultado = \VALFILTER\validaEmail($email, "error@email.com");

    echo "<h3>validaEmail</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $email <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaCadena
    $cadena = "Hola mundo";
    $antes = $cadena;
    $resultado = \VALFILTER\validaCadena($cadena, 20, "Error");

    echo "<h3>validaCadena</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $cadena <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaExpresion
    $codigo = "ABC123";
    $antes = $codigo;
    $resultado = \VALFILTER\validaExpresion(
        $codigo,
        "/^[A-Z]{3}[0-9]{3}$/",
        "Error"
    );

    echo "<h3>validaExpresion</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $codigo <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";

    // validaRango
    $opcion = "rojo";
    $antes = $opcion;
    $colores = ["rojo", "azul", "verde"];
    $resultado = \VALFILTER\validaRango($opcion, $colores);

    echo "<h3>validaRango</h3>";
    echo "Valor inicial: $antes <br>";
    echo "Valor final: $opcion <br>";
    echo "Resultado: " . ($resultado ? "TRUE" : "FALSE") . "<br><br>";
}
