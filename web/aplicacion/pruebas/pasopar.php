<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//datos basicos
$nombre = "Vicente";
$edad = 30;

//un array
$basicos = [
    "nombre" => $nombre,
    "edad" => $edad
];

//relleno otras
$otras = rellenarOtras();


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas básicas");
cuerpo($basicos, $otras); //llamo a la vista
finCuerpo();
// **********************************************************


//vista
function cabecera()
{

    /**
     * Esto va en el head
     */


}

//vista
function cuerpo($bas, $ot)
{
?>
<br><br>
<?php

    echo "Mi nombre es {$bas["nombre"]} de {$bas["edad"]} años".PHP_EOL;


}

function rellenarOtras(){
    return "de 2 daw";
}