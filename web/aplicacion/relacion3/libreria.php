<?php

// Ejercicio 1
/**
 * cuentaVeces es una función a la que le pasamos 4 parametros , la función se encarga de añadir en el array la primera
 * posición indicada con la variable $clave.
 *
 * @param [Array] $array
 * @param [String] $calve
 * @param [int] $valor
 * @param [int] $num2
 * @return boolean
 */
// utilizamos el & delante del array y del num2 para que darle el acceso directo a la variable y que no me cree una copia con el valor de la misma
function cuentaVeces(&$array, $calve, $valor, &$num2)
{
    static $llamadas = 0; // Creaccion en primera llamada , y al llamarlo por segunda vez no lo crea de nuevo

    if (($calve === "2daw") || ($calve === "primera")) {
        return false;
    } else {
        $llamadas++;
        $array[$calve] = $valor;

        $num2 = $llamadas;
        return true;
    }
}

    //Ejercicio2

    /**
     * generarCadena es una función en la cual nos permite pasarle un parametro numerico el cual hace referencia a la 
     * longitud que va a crear la cadena con caracteres permitidos (Letra Máyusculas, minúsulas y números), valor por default = 10
     * devolvera un string si todo sale bien , si no un boolean.
     *
     * @param integer $long
     * @return string
     */
    function generarCadena($long = 10)
    {
        if ($long <= 0) {
            return false;
        }

        $cadena = '';
        for ($i = 0; $i < $long; $i++) {
            // Generar un número ASCII válido
            $ascii = rand(48, 122);

            // Validar que esté dentro de los rangos permitidos
            if (
                ($ascii >= 48 && $ascii <= 57) ||   // Números 0–9
                ($ascii >= 65 && $ascii <= 90) ||   // Letras mayúsculas A–Z
                ($ascii >= 97 && $ascii <= 122)     // Letras minúsculas a–z
            ) {
                $cadena .= chr($ascii);
            } else {
                $i--; // Repetir el ciclo si el carácter no es válido
            }
        }
        return $cadena;
    }

    //Ejercicio3
    /**
     * Operaciones es una función que nos permite introducir todos los numero que queramos dentro de ella
     * el primer parametro $indice se encarga de decir que acción va a realizar la función con los demas numeros
     * que introduzcas, los demas numeros se almacenaran en los argumentos de la funcion para poder operar con ellos.
     * $indice = 1 : Sumamos los numeros<br>
     * $indice = 2 : Restamos los numeros<br>
     * $indice = 3 : Multiplicamos los numeros<br> 
     * $indice = otro numero : Suma las posiciones pares y se resta las impares
     *
     * @param [int] $indice
     * @param [int] ...$otros
     * @return int
     */

    function Operaciones($indice, ...$otros)
    {
        switch ($indice) {
            case 1: // el array_sum nos permite recorrer el array y sumar sus datos 
                return   array_sum($otros);
                break;
            case 2: // utilizamos el array_slice para poder recorrer el array apartir de la posicion que le pongamos 
                return $otros[0] - array_sum(array_slice($otros, 1));
                break;
            case 3: // el array_reduce nos permite recorer el array y acumular sus datos 
                return array_reduce($otros, function ($acumula, $valor) {
                    return $acumula * $valor;
                });
            default: // Sumamos las posiciones pares y restamos las impares     
                $restul = 0;
                $long = count($otros);
                for ($i = 0; $i < $long; $i++) {
                    if ($i % 2 == 0) {
                        $restul = $restul + $otros[$i];
                    } else {
                        $restul = $restul - $otros[$i];
                    }
                }
                return $restul;
        }
    }

    //Ejercicio4 
    /**
     * Devuelve esta funcion tenemos que pasarle 3 parametros de enteros y devuelve la suma de los tres valores en el primer parametro
     * y como resultado de la función el producto de los tres valores.
     * tenemos que pasarle si o si el primer parametro los otros dos son opcionales con valores default.
     *
     * @param integer $num
     * @param integer $num2
     * @param integer $num3
     * 
     */
    function devuelve(&$num, $num2 = 1, $num3 = 10)
    {
        $valor = $num;
        $num = $valor + $num2 + $num3;
        return $valor * $num2 * $num3;
    }

    //Ejercicio5
    /**
     * Funcion Suma , Resta y Multiplicación
     * Piden dos numeros y hacen la operacion correspondiente
     *
     * @param integer $a
     * @param integer $b
     * 
     */
    function suma($a, $b)
    {
        return $a + $b;
    }

    function resta($a, $b)
    {
        if ($a < $b){ // le hacemos esta comprobación para que no nos den numero negativos
            return $b - $a;
        }else{
            return $a - $b;
        }
        
    }

    function multiplicacion($a, $b)
    {
        return $a * $b;
    }

    /**
     * Función hacer Operación
     * Datos a pasarle : <br>
     * 1º Le tenemos que pasar un string con el nombre de la operacion que queremos hacer , Ej: suma<br>
     * 2º Tenemos que pasarle el primer digito con que el que queramos operar<br>
     * 3º Tenemos que pasarle el segundo digito con el que queramos operar<br>
     * 4º Nos devuelve el resultado de la operación<br>
     * 5º Si nos devuelve false es porque hemos escrito mal el nombre de la operacion<br>
     *
     * @param string $operacion
     * @param integer $num1
     * @param integer $num2
     * 
     */
    function hacerOperacion($operacion, $num1, $num2)
    {
// Comprobamos si la operación es válida y ponemos que el nombre de operacion sea en minuscula
        $operacion = strtolower($operacion); 

        if (!in_array($operacion, ['suma', 'resta', 'multiplicacion'])) {
            return false;
        }
        // Creamos una variable que "apunta" a la función
        $funcion = $operacion;
        // Llamamos a la función correspondiente usando la variable
        return $funcion($num1, $num2);
    }



    // Ejercicio 6

    function Afuncion(){
        
    }

















    //Ejercicio6

    function llamadaAFuncion(int $a, int $b, callable $callback): int
    {
        return $callback($a, $b);
    }

    //Ejercicio7
    function ordenar(array &$vector): void
    {
        // Ordenamos el array usando una función anónima como callback
        usort($vector, function ($a, $b) {
            // Compara la longitud de las cadenas de forma descendente
            return strlen($b) <=> strlen($a);
        });
    }

