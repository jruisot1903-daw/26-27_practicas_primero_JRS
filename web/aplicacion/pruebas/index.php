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
        "TEXTO" => "pruebas",
        "LINK" => "/aplicacion/pruebas/index.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas",$barraUbi);
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
    <a href="./basicas.php">Funcionamiento básico</a><br>
    <a href="./pasopar.php">Pasar Parametros</a>
<?php
}
