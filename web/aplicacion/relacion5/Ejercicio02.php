<?php


include_once(dirname(__FILE__) . "/../../cabecera.php");
//Incluyo mis dos librerias (apis)
//controlador

$ubicacion = [
    "pagina principal" => "../../index.php",
    "relacion 5" => "./index.php",
    "Ejercicio 1" => "Ejercicio1.php"
];

//Mi array de valores del formulario
$valores = [
    "nombre" => "",
    "contraseña" => "",
    "fecha_nacimiento" => "",
    "fecha_carnet" => [
        "dia" => "",
        "mes" => "",
        "año" => ""
    ],
    "hora_levantarse" => "",
    "estado" => null,
    "estudios" => [],
    "hermanos" => 0,
    "sueldo" => 1100
];

$errores = [];

/**
 * Comprobamos que se ha enviado el formulario
 */
if (isset($_POST["enviar"])) {

    if (isset($_POST["nombre"])) {
        $valores["nombre"] = mb_strtoupper(mb_trim($_POST["nombre"]));
    }

    if ($valores["nombre"] === "") {
        $errores["nombre"] = "No se puede dejar en blanco el nombre";
    }

    //Solo compruebo la longitud si no está vacío, para no pisar el mensaje anterior
    if ($valores["nombre"] !== "" && !validaCadena($valores["nombre"], 25, "")) {
        $errores["nombre"] = "El nombre no puede tener más de 25 caracteres";
    }
    if (mb_substr($valores["nombre"], 0, 1) === "H") {
        $errores["nombre"] = "El nombre no puede empezar por H";
    }

    //Si no llega la contraseña, el ?? me devuelve una cadena vacía para comprobarlo posteriormente
    $valores["contraseña"] = $_POST["contraseña"] ?? "";
    //expresion regular para la contraseña
    $expresion = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$_\-;<>@]).{8,15}$/u';

    if ($valores["contraseña"] === "") {
        $errores["contraseña"] = "No puede estar en blanco la cadena";
    }

    //Solo compruebo la expresión si no está vacía, para no pisar el mensaje anterior
    if ($valores["contraseña"] !== "" && !validaExpresion($valores["contraseña"], $expresion, "")) {
        $errores["contraseña"] = "Entre 8 y 15 caracteres, con mayúscula, minúscula, cifra y uno de estos: $ _ - ; < > @";
    }


    /**
     * FECHA NACIMIENTO
     */
    if (isset($_POST["fecha_nacimiento"])) {
        $valores["fecha_nacimiento"] = mb_trim($_POST["fecha_nacimiento"]);
    }

    if ($valores["fecha_nacimiento"] === "") {
        $errores["fecha_nacimiento"] = "La fecha no puede estar vacía";
    }
    //Defecto vacío: si falla, el formulario no vuelve con una fecha que el usuario no escribió
    if ($valores["fecha_nacimiento"] !== "" && !validaFecha($valores["fecha_nacimiento"], "")) {
        $errores["fecha_nacimiento"] = "La fecha no es válida";
    }

    /**
     * FECHA DE CARNET
     */
    //Recojo los tres datos, solo si han llegado
    if (isset($_POST["fecha_carnet"]["dia"])) {
        $valores["fecha_carnet"]["dia"] = mb_trim($_POST["fecha_carnet"]["dia"]);
    }
    if (isset($_POST["fecha_carnet"]["mes"])) {
        $valores["fecha_carnet"]["mes"] = mb_trim($_POST["fecha_carnet"]["mes"]);
    }
    if (isset($_POST["fecha_carnet"]["año"])) {
        $valores["fecha_carnet"]["año"] = mb_trim($_POST["fecha_carnet"]["año"]);
    }

    //Si falta alguno de los tres, un único error para el conjunto
    if (
        $valores["fecha_carnet"]["dia"] === ""
        || $valores["fecha_carnet"]["mes"] === ""
        || $valores["fecha_carnet"]["año"] === ""
    ) {
        $errores["fecha_carnet"] = "Debes rellenar día, mes y año";
    } else {
        //Compongo una única fecha con los tres elementos
        $fechaCarnet = $valores["fecha_carnet"]["dia"] . "/"
            . $valores["fecha_carnet"]["mes"] . "/"
            . $valores["fecha_carnet"]["año"];

        //Valido que sea una fecha correcta (si es válida, queda saneada: 1/2/2024 -> 01/02/2024)
        if (!validaFecha($fechaCarnet, "")) {
            $errores["fecha_carnet"] = "La fecha de carnet no es válida";
        } else {
            //Separo la fecha saneada para que las tres cajas vuelvan rellenas
            [$dia, $mes, $anio] = explode("/", $fechaCarnet);
            $valores["fecha_carnet"]["dia"] = $dia;
            $valores["fecha_carnet"]["mes"] = $mes;
            $valores["fecha_carnet"]["año"] = $anio;

            //Solo comparo con el nacimiento si esa fecha ya es correcta (no tiene error)
            if (!isset($errores["fecha_nacimiento"])) {
                //El "!" pone la hora a 00:00:00, para comparar solo días
                $nacimiento = DateTime::createFromFormat("!d/m/Y", $valores["fecha_nacimiento"]);
                $carnet = DateTime::createFromFormat("!d/m/Y", $fechaCarnet);

                //Resto 18 años al carnet y compruebo si queda antes del nacimiento
                $carnetMenos18 = (clone $carnet)->sub(new DateInterval("P18Y"));
                $intervalo = $nacimiento->diff($carnetMenos18);

                //invert = 1 significa que carnetMenos18 es anterior al nacimiento
                if ($intervalo->invert === 1) {
                    $errores["fecha_carnet"] = "El carnet debe ser de una fecha en la que ya tenías 18 años";
                }
            }
        }
    }

    /**
     * Hora de levantarse
     */

    //Compruebo que lo que me llega no es null y lo guardo
    if (isset($_POST["hora_levantarse"])) {
        $valores["hora_levantarse"] = mb_trim($_POST["hora_levantarse"]);
    }

    //Compruebo que no es una cadena vacía
    if ($valores["hora_levantarse"] === "") {
        $errores["hora_levantarse"] = "La hora está vacía";
    }

    //compruebo que la hora es válida (si no está vacía, para no pisar el mensaje anterior)
    if ($valores["hora_levantarse"] !== "" && !validaHora($valores["hora_levantarse"], "")) {
        $errores["hora_levantarse"] = "La hora no es válida";
    }

    /**
     * ESTADO
     */
    //Si no se marca ningún radio, la clave no llega en $_POST
    if (isset($_POST["estado"])) {
        //Se recoge como entero
        $valores["estado"] = (int) $_POST["estado"];
    }

    if ($valores["estado"] === null) {
        //No ha llegado ninguno: es obligatorio
        $errores["estado"] = "Debes elegir un estado";
        //el validarango comprueba que los valores están dentro de nuestro array de estado
    } elseif (!validaRango($valores["estado"], [1, 2, 3, 4])) {
        //Ha llegado algo, pero no es una opción válida (el 5 o un valor manipulado)
        $errores["estado"] = "Has marcado una opción incorrecta";
        //Lo dejo sin marcar al volver a mostrar el formulario
        $valores["estado"] = null;
    }

    /**
     * Estudios
     */

    //Aqui se le pone sin las llaves del array, porque lo que se le pone en html es para que php
    //sepa que cuando le da a enviar el formulario tiene que crearlo, pero aquí la clave que 
    //nos llega es un array ya. Los códigos llegan como string y los dejo como string
    if (isset($_POST["estudios"]) && is_array($_POST["estudios"])) {
        $valores["estudios"] = $_POST["estudios"];
    }

    if (empty($valores["estudios"])) {
        $errores["estudios"] = "No puede estar ninguna sin marcar";
    }

    //Me quedo solo con los códigos válidos (el 6 no lo es) y aviso si había alguno incorrecto
    $correctos = array_values(array_filter(
        $valores["estudios"],
        fn($codigo) => validaRango($codigo, ["0", "1", "2", "3", "4", "5"])
    ));
    if (count($correctos) !== count($valores["estudios"])) {
        $errores["estudios"] = "Has marcado una opción incorrecta";
        $valores["estudios"] = $correctos;
    }

    //aqui compruebo que si tengo mas de dos o dos valores marcados y esta marcado sin estudios
    //no puede seleccionarlo (se queda solo el 0, como array)
    if (count($valores["estudios"]) >= 2 && in_array("0", $valores["estudios"], true)) {
        $valores["estudios"] = ["0"];
    }

    /**
     * Hermanos
     */
    //Comprobamos que no es nulo
    if (isset($_POST["hermanos"])) {
        $valores["hermanos"] = mb_trim($_POST["hermanos"]);
    }

    //Comprobamos que son solo cifras (con (string) por si el valor por defecto es un entero)
    if (!ctype_digit((string) $valores["hermanos"])) {
        $errores["hermanos"] = "Debes introducir un número entero";
    }

    //Convierto el string a numero entero
    $valores["hermanos"] = (int) $valores["hermanos"];

    //Comprobamos que el número está dentro de nuestro rango
    if (!validaEntero($valores["hermanos"], 0, 20, 0)) {
        $errores["hermanos"] = "Se ha pasado del rango, es entre 0 y 20";
    }

    /**
     * Sueldo
     */
    if (isset($_POST["sueldo"])) {
        $valores["sueldo"] = mb_trim($_POST["sueldo"]);
    }

    if (!is_numeric((string) $valores["sueldo"])) {
        $errores["sueldo"] = "No es un valor numérico";
        //Lo dejo en el valor por defecto, para que no se convierta en 0 y salte también el error de rango
        $valores["sueldo"] = 1100;
    }

    $valores["sueldo"] = (float) $valores["sueldo"];

    if (!validaReal($valores["sueldo"], 1000, 150000, 1100)) {
        $errores["sueldo"] = "El sueldo debe estar entre 1000 y 150000";
    }
}

//Solo muestro el resumen si se ha enviado el formulario y no hay ningún error
$mostrarResumen = isset($_POST["enviar"]) && empty($errores);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");


cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $ubicacion);
cuerpo($valores, $errores, $mostrarResumen); //llamo a la vista
finCuerpo();
// **********************************************************
////vista cabecera donde podemos ver otros enlaces 

function cabecera() {}

//vista
function cuerpo(array $valores, array $errores, bool $mostrarResumen)
{
    //Si todo es correcto no se muestra el formulario, solo el resumen
    if ($mostrarResumen) {
        echo resumen($valores);
        return;
    }

    //LOS ECHO SE PONEN EN TODA LA PRÁCTICA PARA QUE SI LE DA ERROR AL MADNA EL FORMULARIO,
    // QUE EL FORMULARIO SE QUEDE RELLENO

    if ($errores) {
        echo "<div class = 'error'>";
        foreach ($errores as $clave => $error) {
            echo "$clave => $error <br>";
        }
        echo "</div>";
    }

    //llamo a la función que dibuja el formulario
    echo formulario($valores, $errores);
}

/**
 * Función que dibuja el formulario. Está separada de la vista, que es la que la llama.
 *
 * @param array $valores valores a mostrar en cada campo
 * @param array $errores errores de validación
 * @return string HTML del formulario
 */
function formulario(array $valores, array $errores): string
{
    ob_start();
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <p>
            <label>Nombre:
                <input type="text" name="nombre"
                    value="<?php echo htmlspecialchars($valores["nombre"]); ?>">
            </label>
        </p>

        <p>
            <label>Contraseña:
                <input type="password" name="contraseña" maxlength="15">
            </label>
        </p>

        <p>
            <label>Fecha de nacimiento (dd/mm/aaaa):
                <input type="text" name="fecha_nacimiento"
                    value="<?php echo htmlspecialchars($valores["fecha_nacimiento"]); ?>">
            </label>
        </p>

        <p>
            Fecha de carnet:
            <input type="text" name="fecha_carnet[dia]" size="2" maxlength="2" placeholder="dd"
                value="<?php echo htmlspecialchars($valores["fecha_carnet"]["dia"]); ?>">
            <input type="text" name="fecha_carnet[mes]" size="2" maxlength="2" placeholder="mm"
                value="<?php echo htmlspecialchars($valores["fecha_carnet"]["mes"]); ?>">
            <input type="text" name="fecha_carnet[año]" size="4" maxlength="4" placeholder="aaaa"
                value="<?php echo htmlspecialchars($valores["fecha_carnet"]["año"]); ?>">
        </p>

        <p>
            <label>Hora de levantarse (hh:mm:ss):
                <input type="text" name="hora_levantarse"
                    value="<?php echo htmlspecialchars($valores["hora_levantarse"]); ?>">
            </label>
        </p>

        <fieldset>
            <legend>Estado</legend>
            <label><input type="radio" name="estado" value="1"
                    <?php if ($valores["estado"] == 1) {
                        echo "checked";
                    } ?>> 1 - Estudiante</label>
            <label><input type="radio" name="estado" value="2"
                    <?php if ($valores["estado"] == 2) {
                        echo "checked";
                    } ?>> 2 - En paro</label>
            <label><input type="radio" name="estado" value="3"
                    <?php if ($valores["estado"] == 3) {
                        echo "checked";
                    } ?>> 3 - Trabajando</label>
            <label><input type="radio" name="estado" value="4"
                    <?php if ($valores["estado"] == 4) {
                        echo "checked";
                    } ?>> 4 - Jubilado</label>
            <label><input type="radio" name="estado" value="5"
                    <?php if ($valores["estado"] == 5) {
                        echo "checked";
                    } ?>> 5 - Incorrecta</label>
        </fieldset>

        <fieldset>
            <legend>Estudios</legend>
            <label><input type="checkbox" name="estudios[]" value="0"
                    <?php if (in_array("0", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 0 - Sin estudios</label>
            <label><input type="checkbox" name="estudios[]" value="1"
                    <?php if (in_array("1", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 1 - Primaria</label>
            <label><input type="checkbox" name="estudios[]" value="2"
                    <?php if (in_array("2", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 2 - Secundaria</label>
            <label><input type="checkbox" name="estudios[]" value="3"
                    <?php if (in_array("3", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 3 - Bachillerato</label>
            <label><input type="checkbox" name="estudios[]" value="4"
                    <?php if (in_array("4", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 4 - Ciclo formativo</label>
            <label><input type="checkbox" name="estudios[]" value="5"
                    <?php if (in_array("5", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 5 - Universitarios</label>
            <label><input type="checkbox" name="estudios[]" value="6"
                    <?php if (in_array("6", $valores["estudios"], true)) {
                        echo "checked";
                    } ?>> 6 - Incorrecta</label>
        </fieldset>

        <p>
            <label>Hermanos:
                <input type="text" name="hermanos"
                    value="<?php echo htmlspecialchars((string) $valores["hermanos"]); ?>">
            </label>
        </p>

        <p>
            <label>Sueldo (€):
                <input type="text" name="sueldo"
                    value="<?php echo htmlspecialchars((string) $valores["sueldo"]); ?>">
            </label>
        </p>

        <p><input type="submit" name="enviar" value="Enviar"></p>
    </form>
<?php
    return ob_get_clean();
}

/**
 * Función que dibuja el resumen con los datos introducidos.
 * Muestra el texto de estado y estudios en lugar de su código.
 *
 * @param array $valores datos ya validados
 * @return string HTML del resumen
 */
function resumen(array $valores): string
{
    //Textos que corresponden a cada código
    $estados = [
        1 => "Estudiante",
        2 => "En paro",
        3 => "Trabajando",
        4 => "Jubilado"
    ];
    $estudios = [
        "0" => "Sin estudios",
        "1" => "Primaria",
        "2" => "Secundaria",
        "3" => "Bachillerato",
        "4" => "Ciclo formativo",
        "5" => "Universitarios"
    ];

    //Convierto los códigos de estudios marcados en sus textos
    $textosEstudios = [];
    foreach ($valores["estudios"] as $codigo) {
        $textosEstudios[] = $estudios[$codigo];
    }

    //Compongo la fecha de carnet con sus tres partes
    $fechaCarnet = $valores["fecha_carnet"]["dia"] . "/"
        . $valores["fecha_carnet"]["mes"] . "/"
        . $valores["fecha_carnet"]["año"];


    //Esto empieza mi objeto para devolverlo despues con el ob_Get_clean
    ob_start();
?>
    <h2>Datos introducidos</h2>
    <ul>
        <li>Nombre: <?php echo htmlspecialchars($valores["nombre"]); ?></li>
        <li>Fecha de nacimiento: <?php echo htmlspecialchars($valores["fecha_nacimiento"]); ?></li>
        <li>Fecha de carnet: <?php echo htmlspecialchars($fechaCarnet); ?></li>
        <li>Hora de levantarse: <?php echo htmlspecialchars($valores["hora_levantarse"]); ?></li>
        <li>Estado: <?php echo htmlspecialchars($estados[$valores["estado"]]); ?></li>
        <li>Estudios: <?php echo htmlspecialchars(implode(", ", $textosEstudios)); ?></li>
        <li>Hermanos: <?php echo htmlspecialchars((string) $valores["hermanos"]); ?></li>
        <li>Sueldo: <?php echo htmlspecialchars(number_format($valores["sueldo"], 2, ",", ".")); ?> €</li>
    </ul>
<?php
    return ob_get_clean();
}