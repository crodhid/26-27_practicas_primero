<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaFunciones.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 4"=> "./index.php",
 ];



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


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
    


?>
<?php
}