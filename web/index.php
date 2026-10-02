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
<<<<<<< HEAD
    Hola, estás en Index.php
    Hola me llamo cristian
    estoy en la rama dev
=======
    <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a>
>>>>>>> main
<?php
}
