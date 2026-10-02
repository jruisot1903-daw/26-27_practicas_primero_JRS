<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

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
inicioCuerpo("Paso Parametros");
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