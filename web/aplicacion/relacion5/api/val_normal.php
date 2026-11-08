<?php

namespace VALNORMAL;

use DateTime;


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
 * Función que comprueba si el número real está entre el mínimo y el máximo, si no lo está se le asigna el
 * valor por defecto
 *
 * @param float $var
 * @param float $min
 * @param float $max
 * @param float $default
 * @return boolean
 */
function validaReal(float &$var, float $min, float $max, float $default): bool
{
    if (($var >= $min) && ($var <= $max)) {
        return true;
    } else {
        $var = $default;
        return false;
    }
}

/**
 * Función que me valida una fecha, spliteo la fecha para comprobar que tiene el delimitador que yo uso. /
 * si este no tiene una longitud de 3 sabemos que está mal por lo tanto le introduzco la por defecto.
 * saco mis dia meses y años, compruebo que son números y que el año tiene 4 cifras, posterior a eso compruebo que la fecha
 * es valida. si todo va bien devuelvo la fecha con el formato correcto, si no la fecha por defecto
 *
 * @param string $fecha
 * @param string $defecto
 * @return boolean
 */
function validaFecha(string &$fecha, string $defecto): bool
{
    $partes = explode("/", trim($fecha));
    if (count($partes) != 3) {
        $fecha = $defecto;
        return false;
    }

    $dia = $partes[0];
    $mes = $partes[1];
    $año = $partes[2];

    // Comprobar que son números y que el año tiene 4 cifras
    if (!ctype_digit($dia) || !ctype_digit($mes) || !ctype_digit($año) || strlen($año) != 4) {
        $fecha = $defecto;
        return false;
    }

    // Comprobar que la fecha existe (31/02 no vale)
    if (!checkdate((int)$mes, (int)$dia, (int)$año)) {
        $fecha = $defecto;
        return false;
    }

    // Devuelvo el string saneado: 2 cifras para día y mes, 4 para el año
    $fecha = sprintf("%02d/%02d/%04d", $dia, $mes, $año);
    return true;
}


/**
 * Funcion que valida la hora, esta lo splitea en un array,
 * comprobamos que sea el formato correcto, que los números no se pasan de un límite
 * si esto está mal se devuelve la hora por defecto con false, si esta bien se crea mi formato de hora y se devuelve true
 *
 * @param string $hora
 * @param string $defecto
 * @return boolean
 */
function validaHora(string &$hora, string $defecto): bool
{
    $arrayHora = explode(":", trim($hora));
    if (count($arrayHora) != 3) {
        $hora = $defecto;
        return false;
    }

    // Cada parte tiene que ser un número de 1 o 2 cifras
    foreach ($arrayHora as $parte) {
        if (!ctype_digit($parte) || strlen($parte) > 2) {
            $hora = $defecto;
            return false;
        }
    }

    // Comprobamos que los valores están dentro de los límites
    if ($arrayHora[0] >= 24 || $arrayHora[1] >= 60 || $arrayHora[2] >= 60) {
        $hora = $defecto;
        return false;
    }

    // Devuelvo el string saneado: 2 cifras para hora, minutos y segundos
    $hora = sprintf("%02d:%02d:%02d", $arrayHora[0], $arrayHora[1], $arrayHora[2]);
    return true;
}

/**
 * Función que me valida el email, si es el formato correcto devuelvo true, si no lo es devuelvo falso, 
 * metiendole el email que me llega por defecto
 *
 * @param string $email
 * @param string $defecto
 * @return boolean
 */
function validaEmail(string &$email, string $defecto):bool{
    //expresion regular para mi email
    $expresion= '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z]{2,}$/';
    //match devuelve 1 si es verdadero, o false si no lo es.
    if (preg_match($expresion, trim($email)) != 1) {
        $email = $defecto;
        return false;
    }

    return true;
}

/**
 * Función que comprueba que una cadena no se pasa de largo de mi límite establecido, si esta se pasa se le mete el valor
 * por defecto.
 *
 * @param string $cadena
 * @param string $longitud
 * @param string $defecto
 * @return bool
 */
function validaCadena(string &$cadena, int $longitud, string $defecto ):bool{
    if (mb_strlen($cadena) > $longitud) {
        $cadena = $defecto;
        return false;
    }
    return true;
}

/**
 * Función que me valida que mi variable "var" cumple con la expresión regular pasada, si no cumple
 * se le asigna el valor por defecto a mi variable var.
 *
 * @param string $var
 * @param string $expresion
 * @param string $defecto
 * @return bool
 */
function validaExpresion(string &$var, string $expresion, string $defecto):bool{
    if (preg_match($expresion, $var) != 1) {
        $var = $defecto;
        return false;
    }
    return true;
}

/**
 * Función que valida si un valor está dentro del array, ya sea como valor ($tipo = 1) o como clave ($tipo = 2)
 *
 * @param mixed $var
 * @param array $posibles
 * @param integer $tipo
 * @return boolean
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    if ($tipo == 2) {
        return (is_int($var) || is_string($var)) && array_key_exists($var, $posibles);
    }
    return in_array($var, $posibles);
}

