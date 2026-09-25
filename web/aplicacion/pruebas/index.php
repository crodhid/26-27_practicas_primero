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
    Elemento de prueba
    <br><br>
    <a href="basicas.php">Funcionamiento básico</a>
<?php
}