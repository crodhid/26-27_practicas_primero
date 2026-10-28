<?php
/**
 * Clase abstracta base para todos los instrumentos
 */
abstract class InstrumentoBase
{
    // Descripción del instrumento (no accesible directamente)
    private string $_descripcion;

    // Edad: no accesible desde fuera, sí desde las clases descendientes
    protected int $_edad = 10;

    // Variable de clase protegida: cuántos instrumentos se han creado
    protected static int $_contador = 0;

    // Orden de creación de esta instancia
    protected int $_orden = 0;

    /**
     * Constructor. Si no llega edad, se usa 10 por defecto
     *
     * @param string $descripcion
     * @param integer $edad
     */
    public function __construct(string $descripcion, int $edad = 10)
    {
        $this->_descripcion = $descripcion;
        $this->_edad = $edad;
        // Primero incremento el contador de clase y después se lo asigno a la instancia
        self::$_contador++;
        $this->_orden = self::$_contador;
    }

    /**
     * Devuelve la descripción
     */
    public function getCadena(): string
    {
        return $this->_descripcion;
    }

    /**
     * Establece la descripción
     */
    public function setCadena(string $cadena): void
    {
        $this->_descripcion = $cadena;
    }

    /**
     * Devuelve la edad
     */
    public function getEdad(): int
    {
        return $this->_edad;
    }

    /**
     * Devuelve una frase que representa el sonido
     */
    abstract public function sonido(): string;

    /**
     * Devuelve los pasos necesarios para afinar el instrumento
     */
    abstract public function afinar(): string;

    /**
     * Aumenta la edad del instrumento en un año
     */
    public function envejecer(): void
    {
        $this->_edad++;
    }

    /**
     * Texto con el que se muestra el objeto en un echo
     */
    public function __toString(): string
    {
        return "instrumento con descripción " . $this->_descripcion
            . ", instancia " . $this->_orden
            . " de un total de " . self::$_contador
            . ". Tiene " . $this->_edad . " años. La clase es " . get_class($this);
    }

    // Sobrecarga dinámica deshabilitada
    public function __get(string $nombre): never
    {
        throw new Exception("No se puede acceder a la propiedad $nombre");
    }

    public function __set(string $nombre, mixed $valor): never
    {
        throw new Exception("No se puede asignar la propiedad $nombre");
    }

    public function __isset(string $nombre): bool
    {
        return false;
    }

    public function __unset(string $nombre): never
    {
        throw new Exception("No se puede eliminar la propiedad $nombre");
    }
}