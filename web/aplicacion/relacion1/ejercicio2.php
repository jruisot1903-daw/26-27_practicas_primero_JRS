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
        "TEXTO" => "Ejercicio 2",
        "LINK" => "/aplicacion/relacion1/ejercicio2.php"
    ]
];

// Creamos las varibles del array donde vamos a almacenar las tiradas de los dados
$tiradas1 = [];
$tiradas2 = array_fill(1,6,0); // Tenemos que rellenar de 0 el array para que no nos de fallo

// Variable constante con valor de 1000
const mil = 1000;

// rellenamos el array con las 6 tiradas del dado 
for ($i = 1; $i <= 6; $i++) {
    $tiradas1[$i] = mt_rand(1, 6);
}


for ($i=1; $i <= mil; $i++) { 
    $lado = mt_rand(1,6);
    $tiradas2[$lado]++; // Vamos almacenando las veces que sale cada lado del dado   
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 2 ", $barraUbi);
cuerpo($tiradas1,$tiradas2,mil); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($tiradas1,$tiradas2,$mil)
{
?>
    <h1>Lanzamiento de dado 6 veces</h1>
    <?php
    for ($i = 1; $i <= count($tiradas1); $i++) {
    ?>
        <br>
<?php
        echo "Lanzamiento {$i} del dado: {$tiradas1[$i]}" . PHP_EOL;
    }
?>
    <h1>Lanzamiento de dado 1000 veces</h1>
    <?php

    foreach ($tiradas2 as $lado => $cantidad) { 
    $porcentaje = ($cantidad / $mil)*100; // obtenemos el % de cada numero 
    echo "<br>Lado $lado: $cantidad con un porcentaje de ".round($porcentaje)."%". PHP_EOL; // Pintamos cada numero con su % correspondiente
}
}
