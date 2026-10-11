<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
/**
 * Barra de ubicacion
 */
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 4"=>"Ejercicio4.php"

 ];

//constante con el número de filas
const numeroFilas = 5;

/**
 * Array con los valores rellenado 
 */

$miArray = [];

/**
 * Array rellenandolo por posiciones
 */
for ($i = 1; $i <= numeroFilas; $i++) {
    for ($j = 0; $j < $i; $j++) {
        $miArray[$i -1][] = $i ;
    }
}



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($miArray); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($miArray)
{

/**
 * Bucle foreach que me recorre mi array por filas y columnas
 */
    foreach ($miArray as $valor) {
        foreach ($valor as $v) {
            echo($v . " ");
        }
        echo("<br>");
    }

?>
<?php
}
