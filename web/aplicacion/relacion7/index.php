<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . '/../../scripts/clases/Punto.php');


/**
 * Me hago dos arrays para poder cargar los select después con los colores y los grosores
 */
$arrayColores = Punto::COLORES;
$arrayGrosores = Punto::GROSORES;

$datos = [
    "x" => 0,
    "y" => 0,
    "color" => "",
    "grosor" => ""
];

$errores = [
    "x" => "",
    "y" => "",
    "color" => "",
    "grosor" => ""
];

//Inicializamos mi mensaje
$mensaje = "";

//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 7" => "./index.php",
];

//creamos la carpeta nueva
$carpetaImagenes = __DIR__ . "/../../imagenes/puntos/";
if (!is_dir($carpetaImagenes)) {
    mkdir($carpetaImagenes, 0777, true);
}
$nombreImagen = nombreImagen();
$rutaImagen = $carpetaImagenes . $nombreImagen;
$rutaPuntos = $carpetaImagenes . nombreFicheroPuntos();

//Array donde voy a ir guardando mis puntos creados
// CAMBIO: lo primero que se hace al acceder es cargar los puntos del fichero
$puntosCreados = cargarPuntos($rutaPuntos);

// NUEVO: cuando se conecta el usuario por primera vez se crea la imagen
// con los puntos cargados (si no hay fichero, solo fondo y marco)
if (!file_exists($rutaImagen)) {
    dibujaImagen($rutaImagen, $puntosCreados);
}

if (isset($_POST["guardar"])) {
    $datos["x"] = $_POST["x"] ?? "";
    if (!validaEntero($datos["x"], 0, 500, 0)) {
        $errores["x"] = "La coordenada x tiene que estar entre 0 y 500";
    }

    $datos["y"] = $_POST["y"] ?? "";
    if (!validaEntero($datos["y"], 0, 500, 0)) {
        $errores["y"] = "La coordenada y tiene que estar entre 0 y 500";
    }

    $datos["color"] = $_POST["color"] ?? "";
    if (!array_key_exists($datos["color"], $arrayColores)) {
        $errores["color"] = "Tienes que seleccionar un color";
    }

    $datos["grosor"] = $_POST["grosor"] ?? "";
    if (!array_key_exists($datos["grosor"], $arrayGrosores)) {
        $errores["grosor"] = "Tienes que marcar un grosor";
    }
  

    if (empty(array_filter($errores))) {
    try {
        $punto = new Punto(
            (int)$datos["x"],
            (int)$datos["y"],
            $datos["color"],
            (int)$datos["grosor"]
        );
        $puntosCreados[] = $punto;   // o array_push($puntosCreados, $punto);
        guardarPuntos($rutaPuntos, $puntosCreados);   
        dibujaImagen($rutaImagen, $puntosCreados);   
        $mensaje = "Punto guardado correctamente";
    } catch (Exception $e) {
        $mensaje = "No se pudo crear el punto: " . $e->getMessage();
    }
}
}

// url de la imagen con el nombre de la imagen
$urlImagen = "../../imagenes/puntos/" . $nombreImagen;


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($arrayColores, $arrayGrosores, $datos, $errores, $mensaje, $puntosCreados, $urlImagen); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($arrayColores, $arrayGrosores, $datos, $errores, $mensaje, $puntosCreados, $urlImagen)
{
    echo formulario($arrayColores, $arrayGrosores, $datos, $errores);

    //Esto es lo que se va a mostrar en el text area
    if ($mensaje !== "") {
        echo "<p>" . $mensaje . "</p>";
    }

    $lineas = "";
    foreach ($puntosCreados as $p) {
        $lineas .= "x: " . $p->getX()
            . " | y: " . $p->getY()
            . " | color: " . $arrayColores[$p->getColor()]["nombre"]
            . " | grosor: " . $arrayGrosores[$p->getGrosor()]
            . "\n";
    }
?>
    <br>
    <textarea rows="10" cols="60" readonly><?php echo $lineas; ?></textarea>
    <br><br>
    <img src="<?php echo $urlImagen; ?>" alt="Puntos" width="500" height="500">
<?php
}

function formulario($arrayColores, $arrayGrosores, $datos, $errores): string
{

    ob_start();

?>
    <form method="post" action="<?php echo ($_SERVER['PHP_SELF']); ?>" novalidate>
        <div>
            <label for="x">Coordenada X</label>
            <input type="number" id="x" name="x" value="<?php echo $datos["x"]; ?>">
            <span class="error"><?php echo $errores["x"]; ?></span>
        </div>
        <br>
        <div>
            <label for="y">Coordenada Y</label>
            <input type="number" id="y" name="y" value="<?php echo $datos["y"]; ?>">
            <span class="error"><?php echo $errores["y"]; ?></span>
        </div>

        <br>

        <div>
            <label>Colores:
                <select name="color">
                    <?php foreach ($arrayColores as $key => $value) { ?>
                        <option value="<?php echo $key; ?>" <?php echo ($datos["color"] === $key) ? "selected" : ""; ?>>
                            <?php echo $value["nombre"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            <span class="error"><?php echo $errores["color"]; ?></span>
        </div>
        <br>
        <div>
            Grosor:
            <?php foreach ($arrayGrosores as $key => $value) { ?>
                <label>
                    <input type="radio" name="grosor" value="<?php echo $key; ?>" <?php echo ((string)$datos["grosor"] === (string)$key) ? "checked" : ""; ?>>
                    <?php echo $value; ?>
                </label>
            <?php } ?>
            <span class="error"><?php echo $errores["grosor"]; ?></span>
        </div>
        <br>
        <button type="submit" name="guardar">Guardar</button>
    </form>


<?php
    return ob_get_clean();
}


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
 * Función para dibujar la imagen
 * Primero creamos el lienzo con fondo blanco que es la imagne basicamente
 * Después sobre ella pintamos los puntos
 * y arriba esta el rectangulo que son los bordes
 *
 * @param string $ruta
 * @param array $puntos
 * @return void
 */
function dibujaImagen(string $ruta, array $puntos): void
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
    //guardamos el fichero
    imagejpeg($imagen, $ruta);
}