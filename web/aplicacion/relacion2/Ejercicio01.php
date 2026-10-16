<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

 $ubicacion = [
 "pagina principal"=> "../../index.php",
 "relacion 1"=> "./index.php",
 "Ejercicio 1"=>"Ejercicio1.php"
 ];

/**
 * CADENA HEREDOC
 */
$nombre="CRISTIAN EL LEGENDARIO";
$texto=<<<fin
Mi querida amiga <br />
escribo estas líneas esperando que me leas. <br />
Firmado: $nombre<br />
fin;

/**
 * CADENA NOWDOC
 * en este caso no se mostraría la variable
 */
$nombre="EL LEGENDARIO CRISTIAN";
$texto2=<<<'fin'
Mi querida amiga <br />
escribo estas líneas esperando que me leas. <br />
Firmado: $nombre <br />
fin;

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");//hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($texto, $texto2); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($texto, $texto2)
{
    echo ("Cadena HEREDOC <br>");
    echo htmlspecialchars($texto) . "<br>" . PHP_EOL;
    echo("<br><br>Cadena NOWDOC<br>");
    echo htmlspecialchars($texto2) . "<br>" . PHP_EOL;


?>
<?php
}