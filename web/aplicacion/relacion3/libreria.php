<?php


// Creamos la funcion cuentaVeces
function cuentaVeces(&$array, $calve, $valor, &$num2)
{
    static $llamadas = 0;

    if (($calve === "2daw") || ($calve === "primera")) {
        return false;
    } else {
        $llamadas++;
        $array[$calve] = $valor;

        $num2 = $llamadas;
        return true;
    }
}