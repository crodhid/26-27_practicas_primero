<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador



 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 1"=>"Ejercicio1.php"

 ];





//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo()
{

$numero = 4.8;
$numeroEntero = 4;
$potencia = 3;
$numeroDecimal = 255;
$numeroBase4 = 123;

/**
 * El round lo que hace es aproximar el número al entero mas cercano
 * el resultado es 5
 */
echo ("Funcionamiento del round: " .round($numero) ."<br>");

/**
 * El floor lo que hace es redondear hacia abajo, el resultado seria 4
 */
echo ("Funcionamiento del floor: " .floor($numero) ."<br>");

/**
 * El pow lo que hace es la potencia 
 */
echo("Funcionamiento del pow: " .pow($numeroEntero , $potencia) ."<br>");

/**
 * El sqrt lo que hace es la raiz cuadrada
 */
echo("Funcionamiento del sqrt: " .sqrt($numeroEntero) ."<br>");


/**
 * Para hacer de entero a hexadecimal usar dechex
 * 
 */
echo ("Funcionamiento del dechex. Número decimal: " . $numeroDecimal . " conversión: " .dechex($numeroDecimal) ."<br>");

/**
 * Para pasar de base 4 a base 8 se utiliza la funcion base_convert
 */
echo ("Numero base 4: " . $numeroBase4 . " conversión a base 8: " .base_convert($numeroBase4,4,8) ."<br>");

/**
 * Funcion que me da el número pi
 */
echo("Funcionamiento del pi: " .pi() ."<br>");

/**
 * Funcion que me devuelve el mínimo de un conjunto de números ingresados
 */
echo ("Funcionamiento del min: " .min($numero , $numeroEntero, $numeroBase4) ."<br>");


/**
 * Variables en distintas bases
 */
$binario = 0b1010; // 10 en decimal
$octal = 012; // 10 en decimal
$hexadecimal = 0xA; // 10 en decimal

// Mostrar valor decimal
echo ("Binario en decimal: " .$binario ."<br>");
echo ("Octal en decimal: " .$octal ." <br>");
echo ("Hexadecimal en decimal: " .  $hexadecimal ."<br>");
// Mostrar en su base original
echo ("Binario: " . decbin($binario) . "<br>");
echo ("Octal: " . decoct($octal) . "<br>");
echo ("Hexadecimal: " . dechex($hexadecimal) . "<br>");


?>
<?php
}