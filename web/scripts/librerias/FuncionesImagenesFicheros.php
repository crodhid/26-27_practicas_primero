<?php
/**
 * El nombre del fichgero tiene la misma ip y navegador que la imagen, entonces cambiamos las dos partes 
 * solo en vez de imagen es puntos_ y en vez de .jpg es .dat
 * lo estamos cambiando en nombreImagen() 
 *
 * @return string
 */
function nombreFicheroPuntos(): string
{
    return str_replace(["imagen_", ".jpg"], ["puntos_", ".dat"], nombreImagen());
}

/**
 * Cargamos los puntos que nos vienen de nuestro fichero y devolvemos el array con los puntos cargados
 * si no se puede devolvemos un array vacio
 *
 * @param string $ruta
 * @return array
 */
function cargarPuntos(string $ruta): array
{
    $puntos = [];

    //comprueba que la ruta existe, si no existe devuelve un array vacio
    if (!file_exists($ruta)) {
        return $puntos;
    }

    //El file_ignore_new_lines hace que ignore el salto de linea del final
    //file_skip_empty_lines ignora las lineas vacias
    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    //si no puede leerse devuelve false y vuelvo a devolver mi array vacío
    if ($lineas === false) {
        return $puntos;
    }

    //recorremos nuestro array de lineas, metiendo cada linea en un nuevo array spliteado por ; 
    //para sacar los datosy trim para quitar espacios en blanco
    foreach ($lineas as $linea) {
        $campos = array_map("trim", explode(";", $linea));
        if (count($campos) !== 4) {
            //si no se ha leido bien, se salta a la siguiente vuelta del foreach
            continue;   
        }
        try {
            $puntos[] = new Punto((int)$campos[0], (int)$campos[1], $campos[2], (int)$campos[3]);
        } catch (Exception $e) {
            // línea con valores no válidos: se ignora
        }
    }

    return $puntos;
}

/**
 * Escribe dentro de mi fichero una línea guardando el nuevo punto con el formato que yo quier
 * el LOCK_EX bloquea el fichero mientras estamos escribiendo para que no se corrompa si hay 2
 * peticiones simultáneas
 *
 * @param string $ruta
 * @param array $puntos
 * @return void
 */
function guardarPuntos(string $ruta, array $puntos): void
{
    $contenido = "";
    foreach ($puntos as $p) {
        $contenido .= $p->getX() . " ; " . $p->getY() . " ; " . $p->getColor() . " ; " . $p->getGrosor() . "\n";
    }
    file_put_contents($ruta, $contenido, LOCK_EX);
}

/**
 * Función que me crea el nombre de mi imagen dependiendo de la ip y del navegador que se abra
 *
 * @return string
 */
function nombreImagen(): string
{
    $ip = str_replace([".", ":"], "_", $_SERVER["REMOTE_ADDR"] ?? "desconocida");
    $agente = $_SERVER["HTTP_USER_AGENT"] ?? "";

    // El orden importa: Edge y Opera también dicen "Chrome", y Chrome también dice "Safari"
    if (mb_stripos($agente, "Edg") !== false) {
        $navegador = "edge";
    } elseif (mb_stripos($agente, "OPR") !== false || mb_stripos($agente, "Opera") !== false) {
        $navegador = "opera";
    } elseif (mb_stripos($agente, "Firefox") !== false) {
        $navegador = "firefox";
    } elseif (mb_stripos($agente, "Chrome") !== false) {
        $navegador = "chrome";
    } elseif (mb_stripos($agente, "Safari") !== false) {
        $navegador = "safari";
    } else {
        $navegador = "otro";
    }

    return "imagen_" . $ip . "_" . $navegador . ".jpg";
}



/**
 * Función que guarda en un fichero la imagen de los puntos
 *
 * @param string $ruta
 * @param array $puntos
 * @return void
 */
function dibujaImagen(string $ruta, array $puntos): void
{
    $imagen = crearImagen($puntos);
    //guardamos el fichero
    imagejpeg($imagen, $ruta);
}

/**
 * Función que crea la imagen en memoria y la devuelve
 * Primero creamos el lienzo con fondo blanco que es la imagne basicamente
 * Después sobre ella pintamos los puntos
 * y arriba esta el rectangulo que son los bordes
 *
 * @param array $puntos
 * @return GdImage
 */
function crearImagen(array $puntos): GdImage
{
    //Creamos el lienzo donde va a estar la imagen de 500px x 500px
    $imagen = imagecreatetruecolor(500, 500);
    //En gd tenemos que crear los colores antes de usarlos, en las dos lineas creamos los colores
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    //pintamos el fondo de color blanco, empieza en el pixel 0,0
    imagefill($imagen, 0, 0, $blanco);

    //Dibujamos cada punto
    foreach ($puntos as $p) {
        //cogemos el color con el que se tiene que dibujar el punto
        $rgb = Punto::COLORES[$p->getColor()]["rgb"];
        //guardamos el color en el gd
        $color = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);
        //guardamos el diametro que viene en el punto
        $diametro = $p->getGrosor() * 4;   // fino 4px, medio 8px, grueso 12px
        //dibuja la elipse del punto es decir el punto siendo el centro x e y, el diametro al ser 
        //el mismo se dibuja un circulo
        imagefilledellipse($imagen, $p->getX(), $p->getY(), $diametro, $diametro, $color);
    }

    //este rectangulo está encima de todo y es simplemente el borde
    imagerectangle($imagen, 0, 0, 499, 499, $negro);   // marco

    return $imagen;
}

/**
 * Función que envía al navegador la imagen de los puntos como descarga jpg,
 * creándola al vuelo (no se lee de ningún fichero)
 *
 * @param array $puntos
 * @param string $nombreFichero nombre con el que se guardará la descarga
 * @return void
 */
function descargaImagen(array $puntos, string $nombreFichero): void
{
    $imagen = crearImagen($puntos);

    //le decimos al navegador que lo que viene es un jpg y que lo descargue en vez de mostrarlo
    header("Content-Type: image/jpeg");
    header("Content-Disposition: attachment; filename=\"" . $nombreFichero . "\"");

    //sin segundo parámetro, imagejpeg escribe la imagen directamente en la respuesta
    imagejpeg($imagen);
}