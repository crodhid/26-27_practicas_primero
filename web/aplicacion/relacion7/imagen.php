<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . '/../../scripts/clases/Punto.php');
require_once(__DIR__ . '/../../scripts/librerias/FuncionesImagenesFicheros.php');

//creamos la carpeta nueva
$carpetaImagenes = __DIR__ . "/../../imagenes/puntos/";
if (!is_dir($carpetaImagenes)) {
    mkdir($carpetaImagenes, 0777, true);
}
$nombreImagen = nombreImagen();
$rutaPuntos = $carpetaImagenes . nombreFicheroPuntos();

$puntos = cargarPuntos($rutaPuntos);

descargaImagen($puntos, "puntos.jpg");