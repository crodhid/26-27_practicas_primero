<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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

// ClaseMisPropiedades (propiedades dinámicas + foreach)
$objeto = new ClaseMisPropiedades();
$objeto->propPublica = "publica";          // propiedad pública real
$objeto->propiedad1 = 25;                  // dinámica -> __set
$objeto->propiedad2 = "cadena de texto";   // dinámica -> __set
$objeto->_propPrivada = "privada";         // se ignora, sigue valiendo 25

// Lecturas que guardamos para mostrarlas en la vista
$lecturaPropiedad1 = $objeto->propiedad1;          // 25
$lecturaPropiedad3 = $objeto->propiedad3;          // false: nunca asignada
$lecturaPrivada = $objeto->_propPrivada;           // false: no accesible desde fuera
$existePropiedad1 = isset($objeto->propiedad1);    // true -> __isset
$existePropiedad3 = isset($objeto->propiedad3);    // false -> __isset

// Recorremos el objeto con foreach (getIterator)
$recorridoObjeto = [];
foreach ($objeto as $clave => $valor) {
    $recorridoObjeto[$clave] = $valor;
}

// Probamos unset: borramos propiedad2 y la volvemos a leer
unset($objeto->propiedad2);                        // -> __unset
$lecturaTrasUnset = $objeto->propiedad2;           // false: ya no existe

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");

cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo(
    $flauta, $flautaDefecto, $clon, $persona, $serieIterator, $serieGenerador,
    $lecturaPropiedad1, $lecturaPropiedad3, $lecturaPrivada,
    $existePropiedad1, $existePropiedad3, $recorridoObjeto, $lecturaTrasUnset
); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces

function cabecera() {}

//vista
function cuerpo(Flauta $flauta,Flauta $flautaDefecto,Flauta $clon,Persona $persona,array $serieIterator,array $serieGenerador,mixed $lecturaPropiedad1,mixed $lecturaPropiedad3,mixed $lecturaPrivada,bool $existePropiedad1,bool $existePropiedad3,array $recorridoObjeto,mixed $lecturaTrasUnset) {
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
    echo "Generador: " . implode(" &nbsp;", $serieGenerador) . "<br><br>";

    echo "CLASE MIS PROPIEDADES<br>";
    echo "la propiedad 1 vale " . $lecturaPropiedad1 . "<br>";
    echo "Leer propiedad3 (no asignada): "
        . ($lecturaPropiedad3 === false ? "no existe (false)" : $lecturaPropiedad3) . "<br>";
    echo "Leer _propPrivada desde fuera: "
        . ($lecturaPrivada === false ? "no accesible (false)" : $lecturaPrivada) . "<br>";
    echo "isset propiedad1: " . ($existePropiedad1 ? "true" : "false") . "<br>";
    echo "isset propiedad3: " . ($existePropiedad3 ? "true" : "false") . "<br>";
    echo "Leer propiedad2 tras unset: "
        . ($lecturaTrasUnset === false ? "no existe (false)" : $lecturaTrasUnset) . "<br>";

    echo "Recorrido con foreach (antes del unset):<br>";
    foreach ($recorridoObjeto as $clave => $valor) {
        echo "&nbsp;&nbsp;$clave => $valor<br>";
    }
}