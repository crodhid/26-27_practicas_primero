<?php


include_once(dirname(__FILE__) . "/../../cabecera.php");
//Incluyo mis dos librerias (apis)
require_once "./api/val_normal.php";
require_once "./api/val_filter.php";
//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 5" => "./index.php",
    "Ejercicio 1" => "Ejercicio1.php"
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


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

    $numCorrecto = 12;
    $numMaloNormal = 100;
    $numMaloFilter = 100;
    $min = 10;
    $max = 20;
    $defecto = 15;

    //Llamo a mi función de forma normal
    $resultadoNormal = \VALNORMAL\validaEntero($numCorrecto, $min, $max, $defecto);
    //llamo a mi función de forma del filter
    $resultadoBuenoFilter = \VALFILTER\validaEntero($numCorrecto, $min, $max, $defecto);

    //Aquí lo que pasaría es que mi variable numMalo se nos guardaria con la variable por defecto
    $resultadoMaloNormal = \VALNORMAL\validaEntero($numMaloNormal, $min, $max, $defecto);
    $resultadoMaloFilter = \VALFILTER\validaEntero($numMaloFilter, $min, $max, $defecto);


    echo "<br><strong>Validación de int (default = 15)</strong>";
    echo "<br><br><strong>Forma normal</strong>";
    echo "<br>Número tras validar de forma normal INT (Correcto): " . $numCorrecto;
    echo "<br>Número tras validar de forma normal  INT (Erróneo):". $numMaloNormal;

    echo "<br><br><strong>Filter</strong>";
    echo "<br>Número tras validar con filter INT (Correcto):". $numCorrecto;
    echo "<br>Número tras validar con filter INT (Erróneo):". $numMaloFilter;

?>
<?php
}
