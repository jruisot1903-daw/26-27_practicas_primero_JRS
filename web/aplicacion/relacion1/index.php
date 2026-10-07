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
        "LINK" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 1 ", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>
    <a href="./ejercicio1.php">Ejercicio1</a><br><br>
    <a href="./ejercicio2.php">Ejercicio2</a><br><br>
    <a href="./ejercicio3.php">Ejercicio3</a><br><br>
    <a href="./ejercicio4.php">Ejercicio4</a><br><br>
    <a href="./ejercicio5.php">Ejercicio5</a><br><br>
    <a href="./ejercicio6.php">Ejercicio6</a><br><br>
    <a href="./ejercicio7.php">Ejercicio7</a><br><br>
<?php
}
