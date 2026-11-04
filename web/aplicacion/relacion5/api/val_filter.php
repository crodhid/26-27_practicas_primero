<?php

namespace VALFILTER;

/**
 * Función que valida con filter, si el número que le llega está dentro del rango de las opciones
 * filter devuelve el número, si no devuelve un booleano falso
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $default
 * @return boolean
 */
function validaEntero(int &$var, int $min, int $max, int $default): bool
{
    $resultado = filter_var($var, FILTER_VALIDATE_INT,[
        'options' => [
            'min_range' => $min,
            'max_range' => $max,
        ],
    ]);
    if ($resultado != false) {
        $var = $resultado;
        return true;
    }else{
        $var = $default;
        return false;
    }
}
