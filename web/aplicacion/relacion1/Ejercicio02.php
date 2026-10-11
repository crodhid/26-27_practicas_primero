<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

/**
 * Barra de ubicacion
 */
 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 2"=>"Ejercicio2.php"

 ];


/**
 * Aqui definimos las variables a utilizar
 * las constantes se definen sin ningun dolar ni nada
 */
const numeroLanzamientos = 6;
const numerosDado = 6;
const milLanzamientos = 1000;

/**
 * Creo el array que va sumando
 */
$array = [0, 0, 0, 0, 0, 0];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($array); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($array)
{
    /**
     * Bucle for hasta 6 que es la constante que tengo arriba definida, para llamarlas no tengo
     * que poner dolar ni nada, esto lo simula con el random que va desde el número minimo hasta el
     * máximo
     */
    for ($i = 0; $i < numeroLanzamientos; $i++) {
        echo ("Lanzamiento " . $i + 1 . " del dado: " . rand(1, numerosDado) . "<br>");
    }

    /**
     * Bucle en el que hacemos 1000 lanzamientos y vamos guardando las estadísticas de cada lanzamiento
     */
    for ($i = 0; $i < milLanzamientos; $i++) {
        $numeroRandom = rand(1, numerosDado);
        switch ($numeroRandom) {
            case '1':
                $array[0]++;
                break;
            case '2':
                $array[1]++;
                break;
            case '3':
                $array[2]++;
                break;
            case '4':
                $array[3]++;
                break;
            case '5':
                $array[4]++;
                break;
            case '6':
                $array[5]++;
                break;
            default:
                break;
        }
    }

    /**
     * Bucle para mostrar las estadística anteriormente sumadas
     */
    for ($i = 0; $i < count($array); $i++) {
        //Variable temporal para tener el valor
        $temporal = $array[$i];
        echo("El " .$i+1 . " ha salido " .$temporal . " con un porcentaje de " .$temporal/10 ."%" ."<br>");
    }

?>
<?php
}
