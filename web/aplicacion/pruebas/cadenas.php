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
{

    /**
     * Esto va en el head
     */

}

//vista
function cuerpo()
{
?>
El niño me ha escrito una carta.
Qué bonita

<?php
}