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
        "TEXTO" => "Relacion 2",
        "LINK" => "/aplicacion/relacion2/index.php"
    ],
    [
        "TEXTO" => "Ejercicio 1",
        "LINK" => "/aplicacion/relacion2/ejercicio1.php"
    ]
];

// Creamos las variables que vamos a utilizar en la vista
$nombre = "Javier";
$texto = " ";

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Ejercicio 1 ", $barraUbi);
cuerpo($texto,$nombre); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($texto, $nombre)
{
?>
    <br><br>
   <h1>Texto con HEREDOC</h1>
<?php

// lo creamos con HEREDOC
// es como un string pero le podemos pasar las varibles sin tener que escapar las comillas 
$texto = <<<fin
Hola $nombre <br>
Caracteres especiales: á é í ó ú ñ \" ' <br>
Etiqueta HTML: &lt;h2&gt;Título&lt;/h2&gt;<br>
fin;

echo $texto;

echo "<h1>Texto con NOWDOC</h1>";

// Lo creamos con NOWDOC
// en este caso no se interpretan las variables ni los caractres especiales, se muestra tal cual lo escribimos
$texto=<<<'fin'
Hola $nombre <br>
Caracteres especiales: á é í ó ú ñ " \' <br>
Etiqueta HTML: &lt;h2&gt;Título&lt;/h2&gt;<br>
fin;

echo $texto;

}
