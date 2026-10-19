<?php

/**
 * Función en la cual le llega un array, le metemos dentro del array en la posicion que especifica
 * la cadena, el primer numero que nos llega, el segundo número es un contador de cuantos elementos
 * tiene dentro nuestro array
 *
 * @param array $array
 * @param string $cadena
 * @param integer $num1
 * @param integer $num2
 * @return boolean
 */
function cuentaVeces(array &$array, string $cadena, int $num1, int &$num2): bool{

    //Hacemos la variable para el contador
    static $cont = 0;
    $cont ++;
    $num2 = $cont;

//Controlamos que si la posicion es 2daw o primera no se me guarden y se salga
    if ($cadena === "2daw" || $cadena === "primera") {
        return false;
    }



    $array[$cadena] = $num1;
    $num2 ++;
    return true;


}
