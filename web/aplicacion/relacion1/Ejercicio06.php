<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

/**
 * Barra de ubicacion
 */
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 6"=>"Ejercicio6.php"

 ];




/**
 * Rellenamos el array con lo que nos piden
 */
$vector=array("primera" =>12.56, 24=>true, 67 =>23.76);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($vector); //llamo a la vista
finCuerpo();

// **********************************************************
//vista cabecera donde podemos ver otros enlaces
function cabecera() {}

//vista
function cuerpo($vector)
{

/**
 * Forma de recorrer el array con las funciones de recorrido
 */
echo("Forma de recorrerlo el array con funciones de recorrido <br>");

while (key($vector) != null) {
    echo current($vector). "<br>";
    next($vector);
}

/**
 * Forma de recorrer el array 
 * con las funciones array_keys y array_values
 * tengo que hacerme dos arrays uno para los valores y otro para las keys
 */

$arrayLlaves = array_keys($vector);
$arrayValores = array_values($vector);

echo("<br> <br>Forma de recorrer el array con las funciones de array_keys y array_values");
for ($i=0; $i < count($arrayLlaves); $i++) { 
    echo("Índice: " . $arrayLlaves[$i] . " Valor: " . $arrayValores[$i] ."<br>");
}

?>
<?php
}