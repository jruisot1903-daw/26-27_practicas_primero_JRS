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
        "TEXTO" => "Pruebas",
        "LINK" => "/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Pasopar",
        "LINK" => "/aplicacion/pruebas/pasopar.php"
    ]
];


//datos basicos
$nombre = "Javier";
$edad = 22;


$basicos=[
    "nombre" => $nombre,
    "edad" => $edad
];
// relleno otras

$otras = rellenoOtras();



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Paso Parametros", $barraUbi);
cuerpo($basicos,$otras); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($bas, $ot)
{

    echo "Mi nombre es {$bas["nombre"]} de {$bas["edad"]} años".PHP_EOL;
    echo "Con otros datos {$ot}".PHP_EOL;
?>
<?php
}

function rellenoOtras(){
    return "de 2 Daw";
}