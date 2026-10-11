<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

/**
 * Barra de ubicacion
 */
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 7"=>"Ejercicio7.php"

 ];



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo(); //llamo a la vista
finCuerpo();

// **********************************************************
//vista cabecera donde podemos ver otros enlaces
function cabecera() {}

//vista
function cuerpo()
{

/**
 * Formato de fecha actual
 */
$fechaActual = date("d/m/y");
echo($fechaActual . "<br>");

/**
 *- Mostrar la fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”.

 */
$fechaFormato = new DateTime();
echo "día: " . $fechaFormato->format("j") . ", mes: " . $fechaFormato->format("F") . ", año: " . $fechaFormato->format("Y") . ", día de la semana: " . $fechaFormato->format("l") . "<br>";


/**
 * - Mostrar la hora actual en el formato “hh:mm:ss”
 */

$fechaHoras = new DateTime();
echo $fechaHoras ->format("h:m:s") . "<br> <br> ";

/**
 * - Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45.
 */
$fecha = new DateTime("2024/03/29 12:45");

echo $fecha ->format("d/m/y") . "<br>";
echo "día: " . $fecha->format("j") . ", mes: " . $fecha->format("F") . ", año: " . $fecha->format("Y") . ", día de la semana: " . $fecha->format("l") . "<br>";
echo $fecha -> format("h:m:s") . "<br> <br>";

/**
 *- Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas 
*/

$fecha2 = new DateTime();
/**
 * A mi fecha actual le estoy restando 12 dias y 4 horas
 * P = Periodo, 12D = 12 dias , T = separa fecha de hora, 4H = 4 horas
 */
$fecha2 ->sub(new DateInterval("P12DT4H"));
echo $fecha2 ->format("d/m/y") . "<br>";
echo "día: " . $fecha2->format("j") . ", mes: " . $fecha2->format("F") . ", año: " . $fecha2->format("Y") . ", día de la semana: " . $fecha2->format("l") . "<br>";
echo $fecha2 -> format("h:m:s") . "<br>";
?>
<?php
}