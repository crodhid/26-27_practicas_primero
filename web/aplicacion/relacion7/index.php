<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . '/../../scripts/clases/Punto.php');
include_once(dirname(__FILE__). "/../../scripts/librerias/FuncionesImagenesFicheros.php");


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
$puntosCreados = cargarPuntos($rutaPuntos);

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

if (isset($_POST["eliminar"])) {
    //El boton nos llega por el nombre del select que es la key
    $indice = $_POST["puntosEliminar"] ?? "";

    if (array_key_exists($indice, $puntosCreados)) {
        unset($puntosCreados[$indice]);
        //lo volvemos a ordenar por las claves para que la key vacía no moleste
        $puntosCreados = array_values($puntosCreados);
        guardarPuntos($rutaPuntos, $puntosCreados);
        dibujaImagen($rutaImagen, $puntosCreados);
    }
}

/**
 * Si le está dando al boton de subir el fichero
 */
if (isset($_POST["subir"])) {
    //los ficheros se guardan en la variable superglobal files
    if (isset($_FILES["fichero"]) && $_FILES["fichero"]["error"] === UPLOAD_ERR_OK) {
        //sacamos la extensión
        $extension = mb_strtolower(pathinfo($_FILES["fichero"]["name"], PATHINFO_EXTENSION));

        //Comprobamos que el fichero que nos ha llegado es de tipo txt
        if ($extension === "txt") {
            //cargarPuntos ya descarta las líneas incorrectas, solo nos devuelve los puntos válidos
            //PHP deja el fichero de forma temporal en tmp_name, esa es la ruta 
            $nuevos = cargarPuntos($_FILES["fichero"]["tmp_name"]);
            //unimos un array con otro para poder dibujar la nueva imagen
            $puntosCreados = array_merge($puntosCreados, $nuevos);
            guardarPuntos($rutaPuntos, $puntosCreados);   // actualiza el .dat
            dibujaImagen($rutaImagen, $puntosCreados);    // actualiza la imagen
            $mensaje = "Se han añadido " . count($nuevos) . " puntos";
        } else {
            $mensaje = "El fichero tiene que ser de tipo txt";
        }

    } else {
        $mensaje = "No se ha podido subir el fichero";
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
    echo formularioPuntos($puntosCreados);
?>
    <br>
    <textarea rows="10" cols="60" readonly><?php echo $lineas; ?></textarea>
    <br><br>
    <?php
    echo formularioCargaFichero()
    ?>
    <br><br>
    <img src="<?php echo $urlImagen; ?>" alt="Puntos" width="500" height="500">
    <br>
    <a href="imagen.php">Descargar Imagen</a>
<?php
}

/**
 * Función para el primer formulario
 *
 * @param [type] $arrayColores
 * @param [type] $arrayGrosores
 * @param [type] $datos
 * @param [type] $errores
 * @return string
 */
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
 * Función para el formulario de los puntos
 *
 * @param array $arrayPuntos
 * @return string
 */
function formularioPuntos(array $arrayPuntos): string
{
    ob_start();

?>
    <form method="post" action="<?php echo ($_SERVER['PHP_SELF']); ?>" novalidate>
        <div>
            <label>Borrar Punto:
                <select name="puntosEliminar">
                    <?php foreach ($arrayPuntos as $key => $value) { ?>
                        <option value="<?php echo $key; ?>">
                            <?php echo $value->getX() . ";" . $value->getY() . ";" . $value->getColor() . ";" . $value->getGrosor(); ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
        </div>
        <button type="submit" name="eliminar">Borrar</button>
    </form>


<?php
    return ob_get_clean();
}


/**
 * Formulario para cargar el fichero
 *
 * @return string
 */
function formularioCargaFichero():string{
    ob_start()
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label>Fichero:
        <input type="file" name="fichero" accept=".txt">
    </label>
    <button type="submit" name="subir">Subir</button>
</form>
<?php
return ob_get_clean();
}