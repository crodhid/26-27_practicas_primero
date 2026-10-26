<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//se crea una instancia de la clase prueba
$instancia = new ClasePrueba();
//accede a la propiedad pública de la instancia
$instancia->propPublica = 50;

//SI CREAMOS MAS VARIABLES LAS ESTATICAS CAMBIA PARA TODAS
$instancia1 = new ClasePrueba();

//se accede a la propiedad de clase (estática), 
ClasePrueba::$propEstatica[1] = 10;
//se accede a la propiedad estática de la clase con nuestra variable que hace referencia a la clase
$instancia::$propEstatica[2] = 20;


$datos = ["codigo" => 12, "nombre" => "prueba2"];
$datosJSon = json_encode($datos);
//no hay constructor público, por lo que tengo que
//llamar a las funciones de creación estaticas
$p1 = Prueba::desdeDatos(5, 'Objeto');
$p2 = Prueba::desdeJson($datosJSon);

//No podriamos porque el constructor es privado
// $inst = new Prueba(12,"cadena");


//Clase 3 de prueba de clase unica
$instancia4 = Unica::crear(100);
//accedemos a la variable pública de mi clase
$instancia4->_numero = 1;

//Hacemos la prueba de que devuelve si el objeto está creado.
$instancia4_1 = Unica::crear(300);

//Hacemos uso de mi clase Instituto
$ins = new Instituto();


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas básicas");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************


//vista
function cabecera()
{

    /**
     * Esto va en el head
     */
}

//vista
function cuerpo()
{
?>

<?php
}

/**
 * Clase prueba usada para mostrar el funcionamiento de los
 * distintos elementos
 */
class ClasePrueba
{
    //definición de constantes
    public const PI = 2.14;
    //definición de propiedad
    public int $propPublica = 1;
    private string $_propPrivada = "hola";
    protected float $_propProtegida = 1.234;
    //definición de propiedad estática
    public static $propEstatica = array(1, 2, 3);
    //definición de método
    public function metodo()
    {
        //acceso a las propiedades desde el propio objeto
        $this->propPublica = 13;
        $this->_propPrivada = 100;
        $this->_propProtegida = "adios";
        //acceso a la propiedad estática
        self::$propEstatica[0] = "otra";
        return true;
    }
}

class Prueba
{
    private ?int $_codigo;
    private ?string $_nombre;
    //el constructor es privado
    private function __construct(?int $codigo = null, ?string $nombre =
    null)
    {
        $this->_codigo = $codigo;
        $this->_nombre = $nombre;
    }
    //constructor estatico publico
    public static function desdeDatos(int $codigo, string $nombre): static
    {
        if ($codigo < 0) {
            $codigo = 0;
        }
        //creo el objeto usando static
        $obj = new static($codigo, $nombre);
        return $obj;
    }
    //constructor estatico publico
    public static function desdeJson(string $json): static
    {
        $datos = json_decode($json);
        return new static($datos->codigo, $datos->nombre);
    }
}

class Unica
{
    private static bool $_creada = false;
    public int $_numero = 12;

    //Le ponemos la interrogación delante para poder definirlo a null
    private static ?Unica $_objeto = null;
    private function __construct(int $val = 0)
    {
        $this->_numero = $val;
    }
    /**
     * Función estática en la cual cada vez que creamos un objeto de la clase, comprobamos si hay alguno
     * creado, si no hay creado lo creamos y lo devolvemos, si no devolvemos el mismo objeto
     *
     * @param integer $numero
     * @return static
     */
    public static function crear(int $numero): static
    {
        //llamamos a creada para verificar que no hay ningun objeto creado de esto.
        if (self::$_creada) {
            //Si esta creado, devolvemos el objeto tal cual
            return self::$_objeto;
        } else {
            //Si no tenemos creado el objeto, lo creamos y lo devolvemos
            $obj = new static($numero);
            self::$_objeto = $obj;
            self::$_creada = true;
            return self::$_objeto;
        }
    }
}
