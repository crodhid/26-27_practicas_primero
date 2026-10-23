<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
include("libreriaFunciones.php");

//Le hacemos nuestra funcion doble al número 12 que le llega como parámetro
$numero = doble(12);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas básicas" );
cuerpo($numero); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo($numero)
{

if ($numero === false) {
    $numero = 10;
}



?>
<?php 


}