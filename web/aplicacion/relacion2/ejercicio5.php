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
        "TEXTO" => "Ejercicio 5",
        "LINK" => "/aplicacion/relacion2/ejercicio5.php"
    ]
];

$cadena = <<<FIN
    <h2>Hola estoy usando heredoc</h2>
    <p>Esto es un texto normal, mi correo es jruisot1903@g.educaand.es</p>
    <pre>123 456 789 098 765</pre>
    FIN;

$devuelto = [];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Ejercicio 5 ", $barraUbi);
cuerpo($cadena); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($cadena)
{
?>

    <h1>Definiendo expresiones regulares</h1>
    <p>Texto: <?= $cadena ?></p><br>

    <p><strong>Mail Encontrados: </strong><br>
        <?php
        $patronCorreo = "/[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,}/";
// recorre la cadena y busca el patron, si lo encuentra lo mete en un array en la posicion 0 la cadena y 1 la pos
        $ret = preg_match_all($patronCorreo, $cadena, $devuelto, PREG_OFFSET_CAPTURE);

        foreach ($devuelto[0] as $mail) {
            echo $mail[0] . ", en la posición " . $mail[1] . "<br>";
        }

        $devuelto = [];
        ?>
    </p>

    <p><strong>Etiquetas encontradas: </strong><br>
        <?php
        $patronEtiquetas = "/<\/?[a-zA-Z0-9]+[^>]*>/";

        $ret = preg_match_all($patronEtiquetas, $cadena, $devuelto, PREG_OFFSET_CAPTURE);

        foreach ($devuelto[0] as $et) {
            echo htmlspecialchars($et[0] . ", en la posición " . $et[1]) . "<br>";
        }

        $devuelto = [];
        ?>
    </p>

    <p><strong>Números encontrados: </strong><br>
        <?php
        $patronNumeros = "/[0-9]{1,}/";

        $ret = preg_match_all($patronNumeros, $cadena, $devuelto, PREG_OFFSET_CAPTURE);

        foreach ($devuelto[0] as $num) {
            echo htmlspecialchars($num[0] . ", en la posición " . $num[1]) . "<br>";
        }

        $devuelto = [];
        ?>
    </p>

<?php
}
