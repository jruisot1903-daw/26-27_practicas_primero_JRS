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
        "TEXTO" => "Ejercicio 5",
        "LINK" => "/aplicacion/relacion1/ejercicio5.php"
    ]
];

// Inicializamos el array y los rellenamos con lo que nos piden

$vector = array();
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = array(2,5,96);
$vector[56] = 23;

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 5 ", $barraUbi);
cuerpo($vector); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($vector)
{
    echo "<br>";
    foreach ($vector as $key => $value) {
        echo "Posición: ".$key." ,contenido (Tipo): ".gettype($value)."<br>";
        $tipo = gettype($value); // guardamos en una variale el tipo del dato

        switch ($tipo){
            case "string":
                echo "&nbsp-".$value."-<br><br>";
            break;

            case "double":
                echo "&nbspNumero: ".$value." al cuadrado es:  ".($value**2)."<br><br>";
            break;
                
            case "boolean":
                echo "&nbsp".(int)$value." ,Opuesto ".!$value."<br><br>"; // he tenido que hacerle un castin a int ya que al utilizar el echo lo pasa a texto y el falso en negativo es un string vacio
            break;
                
            case "array":
                foreach($value as $keys => $valor){
                    echo "&nbsp Posicion del 2 array: ".$keys." contenido: ".$valor."<br><br>"; // &nbsp se utiliza en html para poner un espacio en blanco
                }
            break;
                
            case "integer":
                echo "&nbsp Valor ".$value." en binario ".decbin($value);
            break;
        }
    }
}
