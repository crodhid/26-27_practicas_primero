<?php


include_once(dirname(__FILE__) . "/../../cabecera.php");
//Incluyo mis dos librerias (apis)
require_once "./api/val_normal.php";
require_once "./api/val_filter.php";
//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 5" => "./index.php",
    "Ejercicio 1" => "Ejercicio1.php"
];


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");


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
    // Namespaces de mis dos librerías. Se prueba exactamente lo mismo con las dos
    // para poder comparar que se comportan igual.
    $librerias = ['VALNORMAL', 'VALFILTER'];

    foreach ($librerias as $lib) {
        echo "<hr><h3>Librería $lib</h3>";

        // ---------------- ENTERO (min 10, max 20, defecto 15) ----------------
        echo "<br><strong>validaEntero (min 10, max 20, defecto 15)</strong>";
        $f = "\\$lib\\validaEntero";

        $v = 12;
        $r = $f($v, 10, 20, 15);
        echo "<br>Correcto (12): $v | devuelve " . ($r ? 'true' : 'false');

        $v = 100;
        $r = $f($v, 10, 20, 15);
        echo "<br>Erróneo (100): $v | devuelve " . ($r ? 'true' : 'false');

        $v = 10; // límite inferior, tiene que ser válido
        $r = $f($v, 10, 20, 15);
        echo "<br>Límite (10): $v | devuelve " . ($r ? 'true' : 'false');

        // ---------------- REAL (min 10, max 20, defecto 15) ----------------
        echo "<br><br><strong>validaReal (min 10, max 20, defecto 15)</strong>";
        $f = "\\$lib\\validaReal";

        $v = 12.5;
        $r = $f($v, 10, 20, 15);
        echo "<br>Correcto (12.5): $v | devuelve " . ($r ? 'true' : 'false');

        $v = 100.5;
        $r = $f($v, 10, 20, 15);
        echo "<br>Erróneo (100.5): $v | devuelve " . ($r ? 'true' : 'false');

        // ---------------- FECHA (defecto 01/01/2000) ----------------
        // La variable queda como DateTime, por eso se usa format()
        echo "<br><br><strong>validaFecha (defecto 01/01/2000)</strong>";
        $f = "\\$lib\\validaFecha";

        $v = "25/12/2024";
        $r = $f($v, "01/01/2000");
        echo "<br>Correcta (25/12/2024): " . $v->format('d/m/Y') . " | devuelve " . ($r ? 'true' : 'false');

        $v = "31/02/2024";
        $r = $f($v, "01/01/2000");
        echo "<br>Inexistente (31/02/2024): " . $v->format('d/m/Y') . " | devuelve " . ($r ? 'true' : 'false');

        $v = "2024-12-25";
        $r = $f($v, "01/01/2000");
        echo "<br>Formato malo (2024-12-25): " . $v->format('d/m/Y') . " | devuelve " . ($r ? 'true' : 'false');

        // ---------------- HORA (defecto 00:00:00) ----------------
        echo "<br><br><strong>validaHora (defecto 00:00:00)</strong>";
        $f = "\\$lib\\validaHora";

        $v = "12:30:45";
        $r = $f($v, "00:00:00");
        echo "<br>Correcta (12:30:45): " . $v->format('H:i:s') . " | devuelve " . ($r ? 'true' : 'false');

        $v = "25:61:00";
        $r = $f($v, "00:00:00");
        echo "<br>Fuera de rango (25:61:00): " . $v->format('H:i:s') . " | devuelve " . ($r ? 'true' : 'false');

        $v = "12-30";
        $r = $f($v, "00:00:00");
        echo "<br>Formato malo (12-30): " . $v->format('H:i:s') . " | devuelve " . ($r ? 'true' : 'false');

        // ---------------- EMAIL (defecto sin@email.com) ----------------
        echo "<br><br><strong>validaEmail (defecto sin@email.com)</strong>";
        $f = "\\$lib\\validaEmail";

        $v = "usuario@dominio.com";
        $r = $f($v, "sin@email.com");
        echo "<br>Correcto (usuario@dominio.com): $v | devuelve " . ($r ? 'true' : 'false');

        $v = "esto no es un email";
        $r = $f($v, "sin@email.com");
        echo "<br>Erróneo (esto no es un email): $v | devuelve " . ($r ? 'true' : 'false');

        // Aquí se nota la diferencia: filter sanea (quita el espacio) y lo da por bueno,
        // la expresión regular no.
        $v = "usu ario@dominio.com";
        $r = $f($v, "sin@email.com");
        echo "<br>Con espacio (usu ario@dominio.com): $v | devuelve " . ($r ? 'true' : 'false');

        // ---------------- CADENA (longitud 5, defecto "defecto") ----------------
        echo "<br><br><strong>validaCadena (longitud 5, defecto 'defecto')</strong>";
        $f = "\\$lib\\validaCadena";

        $v = "hola";
        $r = $f($v, 5, "defecto");
        echo "<br>Correcta (hola): $v | devuelve " . ($r ? 'true' : 'false');

        $v = "cadena demasiado larga";
        $r = $f($v, 5, "defecto");
        echo "<br>Demasiado larga (cadena demasiado larga): $v | devuelve " . ($r ? 'true' : 'false');

        // ---------------- EXPRESIÓN (3 dígitos, guion, 2 mayúsculas) ----------------
        echo "<br><br><strong>validaExpresion (/^\d{3}-[A-Z]{2}$/, defecto 'defecto')</strong>";
        $f = "\\$lib\\validaExpresion";
        $expresion = '/^\d{3}-[A-Z]{2}$/';

        $v = "123-AB";
        $r = $f($v, $expresion, "defecto");
        echo "<br>Correcta (123-AB): $v | devuelve " . ($r ? 'true' : 'false');

        $v = "abc";
        $r = $f($v, $expresion, "defecto");
        echo "<br>Errónea (abc): $v | devuelve " . ($r ? 'true' : 'false');

        // ---------------- RANGO ----------------
        echo "<br><br><strong>validaRango</strong>";
        $f = "\\$lib\\validaRango";
        $colores = ["rojo", "verde", "azul"];             // tipo 1: se busca entre los valores
        $codigos = ["r" => "rojo", "v" => "verde"];       // tipo 2: se busca entre las claves

        $r = $f("verde", $colores, 1);
        echo "<br>tipo 1, 'verde' está en los valores | devuelve " . ($r ? 'true' : 'false');

        $r = $f("negro", $colores, 1);
        echo "<br>tipo 1, 'negro' no está en los valores | devuelve " . ($r ? 'true' : 'false');

        $r = $f("v", $codigos, 2);
        echo "<br>tipo 2, 'v' está en las claves | devuelve " . ($r ? 'true' : 'false');

        $r = $f("x", $codigos, 2);
        echo "<br>tipo 2, 'x' no está en las claves | devuelve " . ($r ? 'true' : 'false');

        $r = $f("verde", $codigos, 2);
        echo "<br>tipo 2, 'verde' es un valor, no una clave | devuelve " . ($r ? 'true' : 'false');
    }
}