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
<br><br>
    Elemento de prueba
    <br><br>
    <a href="basicas.php">Funcionamiento básico</a> 
    <br>
    <a href="cadenas.php">Prueba cadenas</a>
    <br>
    <a href="funciones.php">Funciones</a>
    <br>
    <a href="clases.php">Clases</a>
<?php
}