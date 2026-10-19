<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaFunciones.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 3"=> "./index.php",
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
    //Defino mis variables para mi primera funcion
    $miArray = [];
    $cont = 0;
    echo "Funcion CuentaVeces() <br>";

    // if (cuentaVeces($miArray, "alo",1, $cont)) {
    //     echo "Se ha realizado la introducción <br>";
    // } 
    cuentaVeces($miArray, "alo", 23, $cont);
    // }else{
    //     echo "No se ha realizado la introducción <br>";
    // }

    print_r($miArray);

?>
<?php
}