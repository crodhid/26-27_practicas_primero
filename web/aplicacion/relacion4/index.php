<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaFunciones.php");
//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 4" => "./index.php",
];

//Creamos nuestro objeto desde nuestro constructor estático
$flauta = Flauta::crearDesdeArray(["material" => "metal", "edad" => 3]);
//creamos nuestro objeto pero utilizando los valores que tenemos por defecto en el constructor
$flautaDefecto = Flauta::crearDesdeArray([]);   // madera, 15
//le aumentamos un año con el método envejecer
$flautaDefecto->envejecer();
//clonamos nuestra flauta en otra
$clon = clone $flauta;                           // edad 0, nueva instancia

// Persona con estado aleatorio sacado del enum
$casos = EstadoCivil::casos();
$estadoAleatorio = $casos[array_rand($casos)];
$persona = Persona::registrarPersona("Cristian", "15/03/2000", "Calle Real 5", "Antequera", $estadoAleatorio);

// Fibonacci con Iterator y con generador
$serieIterator = [];
foreach (new SerieFibonacci(10) as $valor) {
    $serieIterator[] = $valor;
}
$serieGenerador = [];
foreach (SerieFibonacci::fFibonacci(10) as $valor) {
    $serieGenerador[] = $valor;
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");

cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($flauta, $flautaDefecto, $clon, $persona, $serieIterator, $serieGenerador); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces

function cabecera() {}

//vista
//vista
function cuerpo(Flauta $flauta,Flauta $flautaDefecto,Flauta $clon,Persona $persona,array $serieIterator,array $serieGenerador
) {
    echo "INSTRUMENTOS<br>";
    echo $flauta . "<br>";
    echo $flautaDefecto . "<br>";
    echo "Clon: " . $clon . "<br>";
    echo "Afinar: " . $flauta->afinar() . " | Sonido: " . $flauta->sonido() . "<br>";
    echo "Fabricación: " . $flauta->metodoFabricacion() . "<br>";
    echo "Reciclado: " . $flauta->metodoReciclado() . "<br><br>";

    echo "PERSONA (estado aleatorio)<br>";
    echo $persona . "<br>";
    echo "Valor del estado: " . $persona->getEstado()->valor() . "<br><br>";

    echo "FIBONACCI<br>";
    echo "Iterator: " . implode(" &nbsp;", $serieIterator) . "<br>";
    echo "Generador: " . implode(" &nbsp;", $serieGenerador) . "<br>";
}