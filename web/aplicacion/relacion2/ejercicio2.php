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
        "TEXTO" => "Ejercicio 2",
        "LINK" => "/aplicacion/relacion2/ejercicio2.php"
    ]
];

$cadena = "Está la niña en casa";
$datos = ['cadena' => $cadena];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Ejercicio 2 ", $barraUbi);
cuerpo($datos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($datos)
{
?>
    <h1>EJERCICIO 2:</h1>
    <h3>Con corchetes</h3>
    <?php
    $cadena = $datos['cadena'];
    for ($i = 0; $i < strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp;";
        }
        echo $cadena[$i] . "</p>";
    }

    ?>

    <h3>Con substr</h3>

    <?php

    for ($i = 0; $i < strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp;";
        }
        echo substr($cadena, $i, 1) . "</p>";
    }

    ?>

    <h3>Con mb_substr</h3>

    <?php

    for ($i = 0; $i < mb_strlen($cadena); $i++) {
        echo "<p>";
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp;";
        }
        echo mb_substr($cadena, $i, 1) . "</p>";
    }

    ?>

    <h3>Cadena revertida</h3>

    <?php

    for ($i = mb_strlen($cadena); $i > 0; $i--) {
        echo "<p>";
        for ($j = mb_strlen($cadena) - 1; $j > $i; $j--) {
            echo "&nbsp;";
        }
        echo (($i % 2 == 0) ? (mb_strtoupper(mb_substr($cadena, $i-1, 1))) : (mb_substr($cadena, $i-1, 1)));
        echo "</p>";
    }

    ?>

    <h3>Cadena separada por partes</h3>

    <?php

    $cadenaSeparada = explode("a", $cadena);
    foreach ($cadenaSeparada as $key => $value) {
        echo "<p>$value</p>";
    }

    ?>

    <h3>Remplazar caracter</h3>

<?php

    $posNina=mb_strpos($cadena,"niña");
    if ($posNina===false)
          echo "niña no se encuentra";
        else
        {  
            $posiEs=$posNina+mb_strlen("niña");
            $cadena1=mb_substr($cadena,0,$posiEs)."/mujer ".mb_substr($cadena,$posiEs+1);
            echo $cadena1;
        }
}
