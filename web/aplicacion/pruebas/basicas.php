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
Esto es html
<?php 
    echo "esto esta hecho";
    $var1 = 25;
    $cad1 = 'esto es una cadena';

    $var1 += 12;
    echo $var1;

    $una_cadena='hola';
    $unaCadena = 'adios';

    $var1 -= 17;
    echo $var1;
    $unaCadena = 45;
    echo $unaCadena;

    /**
     * El isset comprueba si una variable esta en nulo o no
     */
    if (isset($cadena2)) {
        echo $cadena2;
    }

    $real = 1234.5678955414654;
    $real += 0.432108766542;

    echo "el numero es $var1 <br>".PHP_EOL;
    //las comillas simples no me sirven para cuando pongo mi variable en el programa
    echo 'el numero es $var1 <br>'.PHP_EOL;

    $real = null;
    echo $real;
    echo "El numero real es $real";


    //Pruebas de conversiones

    //creamos la variable
    $var = 125;
    //devuelve "integer" que es el tipo
    $tipo = gettype($var);
    //la casteamos a string y seria "125"
    $var = (string) $var;
    //metes en la variable true ya que devuelve un booleano
    $var = settype($var, "double");
    //se guarda en el tipo "boolean" 
    $tipo = gettype($var);
    //el intval convierte un valor a entero
    $var = intval($var);
    $tipo = gettype($var);

    //true en matematicas vale 1 entonces la suma es 2
    $var = 1 + true;

    $var = 1+1.5;
    //php intenta leer lo numérico y como la cadena empieza por 1 entonces el resultado es 2
    $var = 1 + "1hola";

    //lo mismo que antes se suma es decir 2 .5
    $var = 1 + "1.5hola";

    //Esto da un error
    $var = 1 + "hola";

    //Esto da un error
    $var = 1+ [];

    $aux = 125;
    $var = 'Hola '. $aux;

        
 ?>
<?php

}