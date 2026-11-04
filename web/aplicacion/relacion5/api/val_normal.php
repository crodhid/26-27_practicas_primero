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
    }else{
        $var = $default;
        return false;
    }
}
