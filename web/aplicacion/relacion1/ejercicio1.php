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
        "TEXTO" => "Ejercicio 1",
        "LINK" => "/aplicacion/relacion1/ejercicio1.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relación 1 - Ejercicio 1 ",$barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    
?>

    <h3>ROUND: </h3>
    <p>echo round(5.045, 2)</p>
<?php
    echo round(5.045, 2).PHP_EOL;
?> 
    <h3>FLOOR: </h3>
    <p>echo floor(9.999)</p>
<?php
    echo floor(9.999).PHP_EOL; 
?>
    <h3>POW</h3>
    <p>echo pow(2,3)</p>
<?php
    echo pow(2,3).PHP_EOL;  
?>
    <h3>SQRT</h3>
    <p>echo sqrt(9)</p>
<?php
    echo sqrt(9), PHP_EOL;

?>
    <h3>De entero a Hexadecimal</h3>
    <p>echo dechex(47)</p>
<?php
    echo dechex(47);
?>
    <h3>De base 4 a base 8</h3>
    <p>base_convert($numBase4, 4, 8)</p>
<?php
    $numBase4 = '100'; 
    echo base_convert($numBase4, 4, 8); 
?>
    <h3>ABS: </h3>
    <p>echo abs(-4.2)</p>
<?php
    echo abs(-4.2);

?>
    <h3>MAX</h3>
    <p>echo max(2, 3, 1, 6, 7)</p>
<?php
    echo max(2, 3, 1, 6, 7), PHP_EOL; 

$binario = 0b1010;     
$octal   = 012;       
$hexa    = 0xA;      
echo "<h3>Definir enteros en diferentes formatos y mostrarlos</h3>";
echo "Valor binario: 0b1010 = " . $binario . " en decimal";
echo "</br>Valor octal: 012 = " . $octal . " en decimal";
echo "</br>Valor hexadecimal: 0xA = " . $hexa . " en decimal";


}