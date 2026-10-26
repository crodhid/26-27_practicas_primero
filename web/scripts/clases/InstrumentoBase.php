<?php
/**
 * Clase abstracta para implementar después herencia
 */
abstract class InstrumentoBase
{
    //Definimos mis variables 
    private ?string $_descripcion;
    //variable que no se puede acceder desde el exterior pero desde sus clases descendientes si
    protected int $_edad;

    //Variable protegida de clase (static) en la cual dice cuantos instrumentos se han creado
    protected static int $_contador = 0;

    //Variable orden es decir, en que posición se ha creado ese objeto
    private int $_orden = 0;

    /**
     * Constructor al cual le llegan los dos parámetros, si no le llega edad, coge 10 por defecto
     *
     * @param string $_descripcion
     * @param integer $edad
     */
    public function __construct(string $_descripcion, int $edad = 10)
    {
        $this->_descripcion = $_descripcion;
        $this->_edad = $edad;
        //Se le suma uno a mi contador de clase para saber cuantos instrumentos se han creado
        self::$_contador++;
        //Le sumo uno al orden, asi se le asigna el orden a mi instrumento
        $this->_orden++;
    }

    /**
     * Función para obtener mi cadena
     */
    public function getCadena(): string
    {
        return $this->_descripcion;
    }

    /**
     * Función para establecer mi cadena con el parámetro que me llega
     *
     * @param string $cadena
     * @return void
     */
    public function setCadena(string $cadena): bool
    {
        return $this->_descripcion = $cadena;
    }

    /**
     * Método abstracto sonido
     *
     * @return void
     */
    abstract function sonido();


    /**
     * Método abstracto afinar
     *
     * @return void
     */
    abstract function afinar();

    /**
     * Función la cual implementa la edad de mi instrumento en 1
     *
     * @return boolean
     */
    public function envejecer(): bool
    {
        return $this->_edad++;
    }

    /**
     * Método toString en el cual redifinimos la cadena con la que queremos que se muestre;
     *
     * @return string
     */
    public function __toString():string {
        return "Instrumento con descripción: " . $this->_descripcion . " Instancia: " . 
        $this -> _orden . " de un total de: " . self::$_contador . " Tiene " . $this->_edad . " años";
    }
}
