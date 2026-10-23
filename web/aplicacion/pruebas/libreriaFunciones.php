<?php

const MIA = 56;

/**
 * Función la cual devuelve el doble de un número que le llega como parámetro
 *
 * @param integer $num //Num al que aplicar el doble
 * @return integer|false //Devuelve el entero si esta bien, falso si el número es menor de 10
 */
function doble(int $num): int|false{
 //$num es menor de 10, consideramos que hay un error
 if ($num<10)
 return false;
 return 2*$num;
}