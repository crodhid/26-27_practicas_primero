<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 3"=>"Ejercicio3.php"
 ];

/**
 * Mi array con todos los caracteres posibles
 */
$caracteres = [
    'a','b','c','d','e','f','g','h','i','j','k','l','m',
    'n','o','p','q','r','s','t','u','v','w','x','y','z',
    'A','B','C','D','E','F','G','H','I','J','K','L','M',
    'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    '0','1','2','3','4','5','6','7','8','9'
];

$texto = "";
 
/**
 * Array de carácteres posibles con el código ASCII
 */
$codigosAscii = [
    // Números 0-9
    48, 49, 50, 51, 52, 53, 54, 55, 56, 57,
    // Mayúsculas A-Z
    65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77,
    78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90,
    // Minúsculas a-z
    97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109,
    110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($caracteres, $texto,$codigosAscii); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($caracteres, $texto,$codigosAscii)
{

echo "Relleno mi cadena de carácteres random <br>";
for($i = 0; $i<20; $i++){
    //aqui para concatenar es con el .
    $texto .= $caracteres[mt_rand(0,count($caracteres)-1)];
}

echo $texto;

echo "<br><br>Relleno mi cadena de carácteres random pero generándolos con los códigos ASCII <br>";

//Limpio mi texto para poder añadir de nuevo
$texto = "";
for($i = 0; $i<20; $i++){
    //aqui para concatenar es con el .
    $texto .= chr($codigosAscii[mt_rand(0,count($caracteres)-1)]);
}

echo $texto;

?>
<?php
}