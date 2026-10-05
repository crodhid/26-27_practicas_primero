<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

/**
 * Creamos el array al ser dinámicos no hay que especificar memoria ninguna
 */
$array1 = [];

/**
 * Primera forma rellenando paso a paso
 */

$array1[1] = "Hola";
$array1[16] = 12;
$array1[54] = 34;

/**
 * Estos dos hacen lo mismo lo añaden al final
 */
//$array1[count($array1)-1] = 1;
$array1[] = 34;

$array1["uno"] = "cadena";
$array1["dos"] = true;
$array1["tres"] = 1.345;
$array1[] = 34;

$array1[] = [1 , 34 , "nueva"];

/**
 * Lo hago de la segunda forma segundo array rellenandolo en una sola sentencia de array
 */

$array2 = array(
    $array2[1] = "Hola",
    $array2[16] = 12,
    $array2[54] = 34,

    //relleno el último carácter
    $array2[] = 34,

    $array2["uno"] = "cadena",
    $array2["dos"] = true,
    $array2["tres"] = 1.345,
    //relleno el último carácter
    $array2[] = 34,
    $array2[] = [1 , 34 , "nueva"]
);

/**
 * Lo hago de la tercera forma usando una sola sentencia con []
 */

$array3 = [
    $array3[1] = "Hola",
    $array3[16] = 12,
    $array3[54] = 34,

    //relleno el último carácter
    $array3[] = 34,

    $array3["uno"] = "cadena",
    $array3["dos"] = true,
    $array3["tres"] = 1.345,
    //relleno el último carácter
    $array3[] = 34,
    $array3[] = [1 , 34 , "nueva"]
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo($array1, $array2, $array3); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($array1, $array2, $array3)
{
    /**
     * Muestro el primer array
     */
    foreach ($array1 as $v1) {
        if (!is_array($v1)) {
            echo($v1 . "<br>");
        }else {
            foreach ($v1 as $v1_2) {
            echo($v1_2. "<br>");
            }
        }
        
    }

    /**
     * Muestro el segundo array
     */

     foreach ($array2 as $v2) {
        if (!is_array($v2)) {
            echo($v2 . "<br>");
        }else {
            foreach ($v2 as $v2_2) {
            echo($v2_2. "<br>");
            }
        }
    }

    /**
     * Muestro el tercer array
     */
     foreach ($array3 as $v3) {
        if (!is_array($v3)) {
            echo($v3 . "<br>");
        }else {
            foreach ($v3 as $v3_2) {
            echo($v3_2. "<br>");
            }
        }
    }


?>
<?php
}
