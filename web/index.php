<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador


$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();  //llamo a la vista
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
    <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a>
    <br>
    <a href="./aplicacion/relacion1/index.php">Relacion 1</a>
    <br>
    <a href="./aplicacion/relacion2/index.php">Relacion 2</a>
    <br>
    <a href="./aplicacion/relacion3/index.php">Relacion 3</a>
    <br>
    <a href="./aplicacion/relacion4/index.php">Relacion 4</a>
<?php
}
