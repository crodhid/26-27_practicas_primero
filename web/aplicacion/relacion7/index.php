<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(__DIR__ . '/../../scripts/clases/Punto.php');
// require_once con la ruta a tu librería de validaEntero, si cabecera.php no la carga


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

//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 7" => "./index.php",
];

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
}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE"); //hola 


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($arrayColores, $arrayGrosores, $datos, $errores); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}
//vista
function cuerpo($arrayColores, $arrayGrosores, $datos, $errores)
{
    echo formulario($arrayColores, $arrayGrosores, $datos, $errores);
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