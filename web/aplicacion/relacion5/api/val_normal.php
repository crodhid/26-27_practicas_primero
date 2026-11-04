<?php

namespace VALNORMAL;


/**
 * Función que comprueba si el número está entre el mínimo y el máximo, si no lo está se le asigna el
 * valor por defecto
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $default
 * @return boolean
 */
function validaEntero(int &$var, int $min, int $max, int $default): bool
{
    if (($var >= $min) && ($var <= $max)) {
        return true;
    } else {
        $var = $default;
        return false;
    }
}


/**
 * Función que comprueba si el número está entre el mínimo y el máximo, si no lo está se le asigna el
 * valor por defecto
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $default
 * @return boolean
 */
function validaReal(int &$var, int $min, int $max, int $default): bool
{
    if (($var >= $min) && ($var <= $max)) {
        return true;
    } else {
        $var = $default;
        return false;
    }
}

function validaFecha(string &$fecha, string $defecto): bool
{
    //spliteo por la barra la fecha
    $arrayFecha = explode("/", trim($fecha));
    if (count($arrayFecha) != 3) {
        return false;
    }

    //compruebo que sea un número y que el ultimo caracter tenga 4 de longitud
    if ((!is_int($arrayFecha[0]))  || (!is_int($arrayFecha[1])) || (!is_int($arrayFecha[2])) || (mb_strlen($arrayFecha[2]) != 4)) {
        $var = $defecto;
        return false;
    }

    //Formato para devlver la fecha
    $var = sprintf("%02d/%02d/%04d", (int)$arrayFecha[0], (int)$arrayFecha[1], (int)$arrayFecha[2]);
    return true;
}
