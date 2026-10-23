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
function cuentaVeces(array &$array, string $cadena, int $num1, int &$num2): bool
{

    //Hacemos la variable para el contador
    static $cont = 0;
    $cont++;
    $num2 = $cont;

    //Controlamos que si la posicion es 2daw o primera no se me guarden y se salga
    if ($cadena === "2daw" || $cadena === "primera") {
        return false;
    }



    $array[$cadena] = $num1;
    $num2++;
    return true;
}

/**
 * Función en la cual si no le llega nada, coge el número 10 por defecto para hacerle el contador
 * Esta función va metiendo carácteres en mi cadena con el random, controla si el número es 0 o negativo
 * devolviendo false, si todo sale bien se devuelve la cadena.
 *
 * @param integer $defecto
 * @return string|boolean
 */
function generarCadena($defecto = 10): string|bool
{

    if ($defecto < 0) {
        return false;
    }

    $cadena = "";
    $contador = 0;
    $caracteres = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    while ($contador < $defecto) {
        $cadena .= $caracteres[mt_rand(0, (count($caracteres) - 1))];
        $contador++;
    }



    return $cadena;
}

/**
 * Función en la cual le llega si o si 3 parámetros, el primero indica que tipo de operacion
 * 1. Suma
 * 2. Resta
 * 3. Multiplicación
 * todo lo que no sean esos números se hace una suma de las posiciones pares de los parámetros
 * una suma de las posiciones impares también, y se resta las pares menos las impares
 *
 * @param integer $tipoOperacion
 * @param integer $num1
 * @param integer $num2
 * @param integer ...$numeros
 * @return integer
 */
function operaciones(int $tipoOperacion, int $num1, int $num2, int ...$numeros): int
{
    $resultado = 0;
    $resultadoPar = $num2;
    $resultadoImpar = $num1;
    switch ($tipoOperacion) {
        case 1:
            $resultado = $num1 + $num2;
            //Esto sería si no estuviera la funcion array_sum 
            // if (count($numeros) > 0) {
            //     foreach ($numeros as $elem) {
            //         $resultado += $elem;
            //     }
            // }
            //el array sum devuelve la suma de todos los componentes dentro de ese array
            $resultado += array_sum($numeros);
            break;
        case 2:
            $resultado = $num1 - $num2;

            if (count($numeros) > 0) {
                foreach ($numeros as $elem) {
                    $resultado -= $elem;
                }
            }
            break;
        case 3:
            $resultado = $num1 * $num2;
            //El array_product multiplica todos los números que tengo dentro de ese array
            //entre ellos mismos
            $resultado = $resultado * array_product($numeros);
            break;
        default:

            for ($i = 0; $i < count($numeros); $i++) {
                if (($i + 1) % 2 == 0) {
                    $resultadoPar += $numeros[$i];
                } else {
                    $resultadoImpar += $numeros[$i];
                }
            }
            $resultado = $resultadoPar - $resultadoImpar;
            break;
    }
    return $resultado;
}

/**
 * Ejercicio 4 funcion devuelve
 * Recibe 3 parámetros, el primero es un parámetro en el cual queremos que se actualice de verdad,
 * por lo cual le ponemos & sumando los valores de los otros parámetros.
 * num1 y num2 tienen un valor por defecto si no introducen nada.
 * Devuelve un resultado tipo int el cual es la multiplicación de los 3
 */
function devuelve(int &$valor, int $num1 = 10, int $num2 = 20): int
{
    $resultado = $valor * $num1 * $num2;
    $valor += $num1 + $num2;
    return $resultado;
}


/**
 * Ejercicio 5
 * Hago 3 funciones suma resta y multiplicacion a la cual a cada una le llegan dos parámetros
 */
function suma(int $num1, int $num2): int
{
    return $num1 + $num2;
}
function resta(int $num1, int $num2): int
{
    return $num1 - $num2;
}
function multiplicacion(int $num1, int $num2): int
{
    return $num1 * $num2;
}

/**
 * Guardo en variables el nombre de las funciones, en PHP guardandolas en variables como cadena
 * el nombre de la función sigue funcionando todo.
 *
 * @param string $cadena
 * @param integer $num1
 * @param integer $num2
 * @return integer|boolean
 */
function hacerOperacion(string $cadena, int $num1, int $num2): int|bool
{
    //Guardo en una variable el nombre de la operación a realizar.
    $operacion = $cadena;
    $resultado = 0;
    //Compruebo que la cadena introducida sea una de esas 3
    if ($operacion != "resta" && $operacion != "suma" && $operacion != "multiplicacion") {
        return false;
    }

    //Como he explicado antes, en php las funciones se pueden ejecutar guardando su nombre
    //previamente
    return $operacion($num1, $num2);
}

/**
 * Ejercicio 6
 * Función que contiene un callable, que esto es igual a si llamas a una función anónima 
 * como parámetro, lo que estoy haciendo aquí es especificarle que dentro de num3 vamos a usar
 * num1 y num2, y en el parámetro especifico la suma, resta o lo que quiera hacer con ellos.
 */
function llamadaAFuncion(int $num1, int $num2, callable $num3)
{
    return $num3($num1, $num2);
}


/**
 * Ejercicio 7, al cual le llega un array y ordena de forma descendente
 */

/**
 * Funcion en la cual le llega un array
 * Para que funcione con cadenas y con todo tenemos que utilizar el operador nave espacial
 * Pero como solo hay que ordenar por carácteres utilizo el mb_strlen
 * @param array $array
 * @return array
 */
function ordenar(array &$array): bool
{
    //el $b - $a solo funciona bien con números enteros, para que funcione con todo
    //utilizamos el operador nave espacial <=> pero esto no es ordenar por número de carácteres
    //esto ordena por orden alfábetico lo he leido mal
    //usort($array, fn($a, $b) => $b - $a);
    // usort($array, fn($a, $b) => $b <=> $a);

    //Comprobamos que todos los componentes de mi array son cadenas
    $boolean = true;
    $contador = 0;
    while ($contador < count($array) && $boolean == true) {
        if (!is_string($array[$contador])) {
            $boolean = false;
        }
        $contador ++;
    }

    //Si todos son cadenas el programa sigue si no devuelve falso
    if (!$boolean) {
        return false;
    }
    //Ordenamos por longitud de numeros de carácteres en mi cadena
    usort($array, fn($a, $b) => mb_strlen($b) - mb_strlen($a));
    return true;
}
