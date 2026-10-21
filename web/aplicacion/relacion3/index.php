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
    echo "<strong>Ejercicio 1 Funcion CuentaVeces()</strong> <br>";

    // if (cuentaVeces($miArray, "alo",1, $cont)) {
    //     echo "Se ha realizado la introducción <br>";
    // } 
    cuentaVeces($miArray, "alo", 23, $cont);
    // }else{
    //     echo "No se ha realizado la introducción <br>";
    // }

    print_r($miArray);


    //Ejercicio 2 generar cadena
    echo "<br> <br> <strong>Ejercicio 2 generando la cadena, controlando que no sea menor de 0</strong> <br>";
    echo "<br>". generarCadena(13);
    $cadena = generarCadena(-1);
    if (!$cadena) {
        echo "<br>El número no puede ser negativo o 0";
    }

    //Ejercicio 3 hacer operacion
    echo "<br><br><strong>Ejercicio 3 funcion de operaciones</strong><br>";
    echo "Resultado suma: " . operaciones(1,2,3,4,5,6);
    echo "<br>Resultado resta: " . operaciones(2,6,2,3,2);
    echo "<br>Resultado multiplicación: " . operaciones(3,4,5,6);
    echo "<br>Resultado otro carácter: " . operaciones(4, 4,4,5,6);
    
    //Ejercicio 4 funcion devuelve
    $valor = 7;
    echo "<br><br><strong>Ejercicio 4 función devuelve</strong><br>";
    echo"<br>Resultado llamando los 3 valores: " . devuelve($valor, 5,6);
    echo "<br>Valor después de la primera: " . $valor;
    $valor = 7;
    echo"<br>Resultado llamando los 2 primeros parámetros: (el tercero vale 20) " . devuelve($valor, 5);
    echo "<br>Valor después de la primera: " . $valor;
    //Para ignorar uno, tengo que especificar tal cual el valor del tercero
    $valor = 7;
    echo"<br>Resultado llamando el primero y el último: (el segundo vale 10) " . devuelve($valor, num2:5);
    echo "<br>Valor después de la primera: " . $valor;
    $valor = 7;
    echo"<br>Resultado llamando solo el primer parámetro: " . devuelve($valor);
    echo "<br>Valor después de la primera: " . $valor;


    //Ejercicio5 hacerOperacion
    echo "<br><br><strong> Ejercicio 5 función hacerOperacion()</strong><br>";
    echo "<br>". hacerOperacion("resta",5,8);

    //Ejercicio 6 funcion llamadaAFuncion()
    echo "<br><br><strong>Ejercicio 6 llamadaAFuncion() </strong><br>";
    //aqui es donde dentro del callable se pone la función anónima, podiendo poner yo aquí 
    //lo que yo quiera
    echo "<br>" .llamadaAFuncion(1,3,fn($a,$b)=> $a ."+" .$b ." = " .$a+$b);

?>
<?php
}