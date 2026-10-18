<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 2"=> "./index.php",
 "Ejercicio 4"=>"Ejercicio4.php"
 ];


 /**
  * Defino mis dos números
  */
$num1 = 17.5;
$num2 = 379987.24;


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($num1, $num2); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($num1, $num2)
{
    


// number_format(número, decimales, separador decimal, separador de millares)
//$num1, 1, ',', '.') esto hace que el num1 lo convierte 17.5 en "17,5" (1 decimal, coma decimal)
//con num2  2 decimales sale "379.987,24" estamos cambiando el . por la coma, despues le añadimos 
//str_pad que rellena por la izquierda hasta llegar a 15 caracteres, con ceros en el primero y con espacios en el segundo.
$primero = str_pad(number_format($num1, 1, ',', '.'), 15, "0", STR_PAD_LEFT);
$segundo = str_pad(number_format($num2, 2, ',', '.'), 15, " ", STR_PAD_LEFT);

//hay que utilizar el replace para los espacios porque php colapsa los espacios vacíos por lo tanto no se verían
echo "el primer valor -" . $primero . "-, el segundo valor -" . str_replace(" ", "&nbsp;", $segundo) . "-";

?>
<?php
}