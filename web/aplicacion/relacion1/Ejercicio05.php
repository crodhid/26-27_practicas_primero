<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
/**
 * Barra de ubicacion
 */
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 5"=>"ejercicio5.php"

 ];


/**
 * Rellenamos el array con lo que nos piden
 */
$vector = array();
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = array(2, 5, 96);
$vector[56] = 23;

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
     * Bucle foreach en el cual tenemos la posicion y el contenido dentro de cada posición
     * en el que pregunto el tipo del contenido y dependiendo del tipo hago una cosa u otra con el switch
     */
    foreach ($vector as $posicion => $contenido) {
        echo ("Posición: " . $posicion . " tipo del contenido: ");
        if (!is_array($contenido)) {
            $tipoElem = gettype($contenido);
            switch ($tipoElem) {
                case "string":
                    echo ("Cadena: " . $contenido . "<br>");
                    break;
                case "integer":
                    echo ("Entero con valor: " . $contenido . ", en binario: " . decbin($contenido) . "<br>");
                    break;
                case "double":
                    echo ("Real con valor: " . $contenido . " que al cuadrado es: " . pow($contenido, 2) . "<br>");
                    break;
                case "boolean":
                    if ($contenido) {
                        echo ("Es un booleano verdadero y su contrario es falso " . "<br>");
                    } else {
                        echo ("Es un booleano falso y su contrario es verdadero" . "<br>");
                    }
                    break;
                default:
                    break;
            }
        } else {
            echo ("array. lo recorro<br>");
            foreach ($contenido as $c1) {
                echo ($c1 . "<br>");
            }
        }
    }
?>
<?php
}
