<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 2"=> "./index.php",
 "Ejercicio 5"=>"Ejercicio5.php"
 ];

 // Guardamos mi cadena con el nowdoc (este no interpreta ni variables ni escapes)
$cadena = <<<'TEXTO'
<h1>Titulo de la pagina</h1>
Tengo 3 gatos y 25 peces
<p>Contacto: ana@correo.es</p>
El pedido 1024 llegara en 7 dias
Escribe a juan.perez@empresa.com o a info@web.org
<a href="#">Enlace</a> con 150 visitas
TEXTO;

// Expresiones regulares
$reTag    = '/<\/?[a-z][a-z0-9]*[^>]*>/i';          // <h1>, </p>, <a href="#">
//esto hace que el número no tengo nada ni antes ni detrás
//el \b es q haya un espacio en blanco antes, \d+ d= decimal  += mas numeros \b separado de nuevo
$reNumero = '/\b\d+\b/';                              // uno o varios dígitos
$reEmail  = '/[a-z0-9._-]+@[a-z0-9-]+\.[a-z]{2,}/i';  // aaaa@aaaa.aa

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($cadena, $reTag, $reNumero, $reEmail); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($cadena, $reTag, $reNumero, $reEmail)
{

//Mostramos la cadena con los carácteres especiales
//el pre lo que hace es que el navegador me mantenga mi texto tal cual como lo he escrito yo
echo "<pre>" . htmlspecialchars($cadena) . "</pre>";

// ---- Etiquetas ----
echo "<h3>Etiquetas HTML</h3>";
$busqueda = 0;
/**
 * Funcionamiento de los bucles,
 * el preg_match busca la primera coincidencia en la posicion de $busqueda, 
 * como este no nos devuelve la posicion en la que encontramos el texto lo buscamos con strpos
 * lo que hace el match es q a partir de busqueda va saltando es decir h1 esta en la posicion 0, despues se salta todo hasta llegar
 * a la siguiente y asi, lo va metiendo en $m
 */
while (preg_match($reTag, $cadena, $m, 0, $busqueda)) {
    $posicion = strpos($cadena, $m[0], $busqueda);
    echo "Posición " . $posicion . ": " . htmlspecialchars($m[0]) . "<br>";
    $busqueda = $posicion + strlen($m[0]);
}

// ---- Números ----
echo "<h3>Números</h3>";
$busqueda = 0;

while (preg_match($reNumero, $cadena, $m, 0, $busqueda)) {
    $posicion = strpos($cadena, $m[0], $busqueda);
    echo "Posición " . $posicion . ": " . $m[0] . "<br>";
    //cuando encuentra lo que quiere, actualiza donde acaba ese texto por ejemplo encuentra h1 en la posicion 0, este acaba en la 2 
    //entonces se actualiza a 2 para empezar a buscar desde ahi despues
    $busqueda = $posicion + strlen($m[0]);
}

// ---- Emails ----
echo "<h3>Emails</h3>";
$busqueda = 0;
while (preg_match($reEmail, $cadena, $m, 0, $busqueda)) {
    $posicion = strpos($cadena, $m[0], $busqueda);
    echo "Posición " . $posicion . ": " . $m[0] . "<br>";
    $busqueda = $posicion + strlen($m[0]);
}

?>
<?php
}