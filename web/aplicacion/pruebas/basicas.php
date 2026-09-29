<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas básicas");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo()
{
?>
<br><br>
Esto es html
<?php 
    echo "esto esta hecho";
    $var1 = 25;
    $cad1 = 'esto es una cadena';

    $var1 += 12;
    echo $var1;

    $una_cadena='hola';
    $unaCadena = 'adios';

    $var1 -= 17;
    echo $var1;
    $unaCadena = 45;
    echo $unaCadena;

    if (isset($cadena2)) {
        echo $cadena2;
    }

 ?>
<?php

}