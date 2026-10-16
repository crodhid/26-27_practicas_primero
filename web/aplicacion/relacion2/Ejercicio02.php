<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 2"=> "./index.php",
 "Ejercicio 2"=>"Ejercicio2.php"
 ];

$texto = "Está la niña en casa" ;
$tamaño = mb_strlen($texto);
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($texto, $tamaño); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($texto, $tamaño)
{

/*
 * Forma NO válida para UTF8.
 *
 * for($i=0; $i<strlen($cadena); $i++)
 * {
 *     echo str_repeat(" ", $i);
 *     echo $cadena[$i] . PHP_EOL;
 * }
 */

/*
 * Forma NO válida para UTF8.
 * substr tampoco trata correctamente caracteres multibyte.
 *
 * for($i=0; $i<strlen($cadena); $i++)
 * {
 *     echo str_repeat(" ", $i);
 *     echo substr($cadena, $i, 1) . PHP_EOL;
 * }
 */

/*
 * Forma correcta usando mb_substr.
 */
$espacio = "&nbsp";
for ($i = 0; $i < $tamaño; $i++) {

   echo str_repeat("&nbsp ", $i);

    echo mb_substr($texto, $i, 1);

    echo "<br>";

}
?>
<?php
}