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
    <br><br>
    <a href="Ejercicio01.php">Ejercicio 1</a> 
    <br>
    <a href="Ejercicio02.php">Ejercicio 2</a>
    <br>
    <a href="Ejercicio03.php">Ejercicio 3</a>
    <br>
    <a href="Ejercicio04.php">Ejercicio 4</a>
    <br>
    <a href="Ejercicio05.php">Ejercicio 5</a>
<?php
}