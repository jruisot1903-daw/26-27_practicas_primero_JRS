<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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
        "TEXTO" => "Relacion 4",
        "LINK" => ""
    ]
];

//controlador
 $flautas = [
        Flauta::crearDesdeArray(['material' => 'plástico', 'edad' => 5]),
        Flauta::crearDesdeArray(['material' => 'metal', 'edad' => 2]),
        Flauta::crearDesdeArray([]), // usa valores por defecto
    ];

// Obtener todos los casos posibles del enum
$estados = EstadoCivil::casos();

// Elegir uno aleatorio
$estadoAleatorio = $estados[array_rand($estados)];

// Crear una persona con ese estado
$persona = Persona::registraPersona(
    "Jose Luís",
    "10/09/1995",
    "Calle Mayor 15",
    "Albacete",
    $estadoAleatorio
);

$Objeto= new ClasesMisPropiedades ();
$Objeto->propPublica="publica";
$Objeto->_propPrivada="privada"; 
$Objeto->propiedad1=25;
$Objeto->propiedad2= "cadena de texto";

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 4 ", $barraUbi);
cuerpo($flautas,$persona,$Objeto); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($flautas,$persona,$Objeto)
{
    echo "<h1>Clases, Objetos y Enumeraciones</h1>";

    /* Probandolo antes de ser abstracta 
    echo "<h2>Ejercicio1: </h2>";
    echo "<h1>Prueba InstrumentosBase</h1><br>";
    $objt1 = new InstrumentoBase("Maracas",20);
    $objt2 = new InstrumentoBase("Maracas",21);
    
    echo "$objt1";
    echo "$objt2";*/

    echo "<h2>Probando Clase InstumentoViento</h2>";
     $InstrumentoViento = new InstrumentoViento("Metal",20);
     $InstrumentoViento->setDescripcion("payo");
     echo $InstrumentoViento."<br>";
     echo $InstrumentoViento->sonido()."<br>";
     echo $InstrumentoViento->afinar();
     
     echo "<h2>Probando Clase Flauta</h2>";
     // le hacemos el foreach para sacar todas las flautas que tenemos creadas
    foreach ($flautas as $flauta) {
        echo $flauta . "<br>";
    }

    echo "<h2>Probando Clase Persona y Estado Civil</h2>";
    echo $persona;

    echo "<h2>Probando Clase SerieFibonacci</h2>";
    foreach (new SerieFibonacci(10) as $valor) {
        echo "$valor&nbsp;";
    }

    echo "<br>Usando el generador:<br>";
    foreach (SerieFibonacci::fFibonacci(10) as $valor) {
        echo "$valor&nbsp;";
    }
    
    echo "<h2>Probando Clase Mis Propiedades</h2>";
    echo "Ejemplo propiedad 1: " . $Objeto->propiedad1 . "<br>";
}
