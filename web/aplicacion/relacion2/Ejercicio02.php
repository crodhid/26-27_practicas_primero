<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 2"=> "./index.php",
 "Ejercicio 2"=>"Ejercicio2.php"
 ];

$texto = "Está la niña en casa" ;
//sacamos el tamaño de nuestra cadena de texto
$tamaño = mb_strlen($texto);
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($texto, $tamaño); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($texto, $tamaño)
{

/*
 * Forma NO válida para UTF8.
 *
 * for($i=0; $i<strlen($cadena); $i++)
 * {
 *     echo str_repeat(" ", $i);
 *     echo $cadena[$i] . PHP_EOL;
 * }
 */

/*
 * Forma NO válida para UTF8.
 * substr tampoco trata correctamente caracteres multibyte.
 *
 * for($i=0; $i<strlen($cadena); $i++)
 * {
 *     echo str_repeat(" ", $i);
 *     echo substr($cadena, $i, 1) . PHP_EOL;
 * }
 */

/*
 * Forma correcta usando mb_substr.
 */
$espacio = "&nbsp";
for ($i = 0; $i < $tamaño; $i++) {
    //Esto repite lo que hay en la primera posicion las veces que se ponga en la segunda posicion, en este caso los espacios
    // $i veces
   echo str_repeat("&nbsp ", $i);

   //Esto extrae el caracter en la posicion i de nuestra cadena, especificandole la cantidad que queremos mostrar en este caso 1
    echo mb_substr($texto, $i, 1);

    echo "<br>";

}


/**
 * Recorro mi array ahora pero de forma inversa, mostrando los pares en mayuscula y los impares en minuscula
 */

echo "<br> Recorro el array de forma inversa mostrando en mayuscula posiciones pares y las impares en minuscula";
$contador = 0;
for(; $tamaño >= 0; $tamaño--){
    $contador++;
    echo str_repeat("&nbsp ", $contador);
    if (($tamaño % 2) == 0) {
           //Esto extrae el caracter en la posicion i de nuestra cadena, especificandole la cantidad que queremos mostrar en este caso 1
            echo mb_strtoupper(mb_substr($texto, $tamaño, 1));
    }else {
            echo mb_strtolower(mb_substr($texto, $tamaño, 1));
        
    }

    echo "<br>";
}

/**
 * Recorro mi array pero separandolo por partes cuando sale la letra a
 */
$textoSeparado = explode("a",$texto);
echo "<br> Texto separado por el carácter a por partes <br>";
foreach ($textoSeparado as $elem) {
    echo ($elem . "<br>");
}


/**
 * Reemplazo la palabra niña por mujer en mi cadena
 */

$textoMujer = str_replace("niña","mujer", $texto);
echo "<br>Texto cambiando niña por mujer <br>";
echo $textoMujer;

?>
<?php
}