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
        "TEXTO" => "Ejercicio 4",
        "LINK" => "/aplicacion/relacion2/ejercicio4.php"
    ]
];

$num1 = number_format(17.5, 1, ",", ".");
$num2 = number_format(379987.24,2,",",".");
$text = "";
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Ejercicio 4 ", $barraUbi);
cuerpo($num1, $num2,$text); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($num1,$num2,$text)
{
    ?>

<h1>Separado por 0</h1>
<div>
    <?php 
// str_pad nos rellena una cadena Y Left para que lo rellene por la izquierda , si queremos por la derecha le pondriamos Right
        echo str_pad($num1,15,'0',STR_PAD_LEFT);
    ?> 
</div>
<br>
<h1>Separado por espacios</h1>
<div>
    <?php 
        $text =  str_pad($num2,15,' ',STR_PAD_RIGHT);
        echo str_replace(' ', '&nbsp;', $text);
    ?>
</div>

<?php
}
