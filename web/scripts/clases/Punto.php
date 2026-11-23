<?php

class Punto
{

    /**
     * Clase colores en la cual es un array asociativo, con los nombres de las claves en ingles
     * y dentro de ella tenemos de nombre de valores el nombre del color en español y el rgb que es un array
     */
    public const COLORES = [
        "red" => ["nombre" => "rojo", "rgb" => [255, 0, 0]],
        "blue" => ["nombre" => "azul", "rgb" => [0, 0, 255]],
        "green" => ["nombre" => "verde", "rgb" => [0, 255, 0]],
        "orange" => ["nombre" => "naranja", "rgb" => [255, 128, 0]]
    ];

    /**
     * Constante de array asociativo en la que gu   ardo los grosores.
     */
    public const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso"
    ];

    /**
     * Variables de instancia
     *
     * @var integer
     */
    private int $_x, $_y, $_grosor;
    private string $_color;



    /**
     * Constructor en el que preguntamos cuando guardamos si devuelve falso, si devuelve falso
     * le lanzo una excepción especificando lo que pasa
     *
     * @param integer $x
     * @param integer $y
     * @param string $color
     * @param integer $grosor
     */
    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if (!$this->setX($x)) {
            throw new Exception("La coordenada x no está dentro del rango 0 y 20000");
        }

        if (!$this->setY($y)) {
            throw new Exception("La coordenada y no está dentro del rango 0 y 20000");
        }

        if (!$this->setColor($color)) {
            throw new Exception("El color no está dentro de la constante colores, ese color no existe");
        }

        if (!$this->setGrosor($grosor)) {
            throw new Exception("El grosor no existe en la constante grosores");
        }

        
    }



    /***
     * GETTERS AND SETTERS
     */

    /**
     * Función para obtener x
     *
     * @return integer
     */
    public function getX(): int
    {
        return $this->_x;
    }

    /**
     * Función para guardar la x este valida que este dentro de un rango o no
     *
     * @param integer $x
     * @return boolean
     */
    public function setX(int $x): bool
    {
        if (validaEntero($x, 0, 20000, 0)) {
            $this->_x = $x;
            return true;
        }
        return false;
    }

    /**
     * Función para obtener y
     *
     * @return integer
     */
    public function getY(): int
    {
        return $this->_y;
    }

    /**
     * Función que setea y, pero solo si está dentro de un rango o no
     *
     * @param integer $y
     * @return boolean
     */
    public function setY(int $y): bool
    {
        if (validaEntero($y, 0, 20000, 0)) {
            $this->_y = $y;
            return true;
        }
        return false;
    }


    /**
     * Función que me devuelve mi color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->_color;
    }

    /**
     * Función que me comprueba si el color que me han dado en inglés lo tengo como clave o no
     * para poder guardarlo en mi variable
     *
     * @param string $color
     * @return boolean
     */
    public function setColor(string $color): bool
    {
        $estado = false;
        foreach (self::COLORES as $key => $value) {
            if ($key == $color) {
                $this->_color = $color;
                $estado = true;
            }
        }
        return $estado;
    }

    /**
     * Función que devuelve mi grosor
     *
     * @return integer
     */
    public function getGrosor(): int
    {
        return $this->_grosor;
    }

    /**
     * Función que me comprueba si dentro de mi array existe esa key, si existe la guarda y devuelve true
     * si no, no guarda nada y devuelve false
     *
     * @param integer $grosorNumero
     * @return bool
     */
    public function setGrosor(int $grosorNumero):bool
    {

        if (array_key_exists($grosorNumero, self::GROSORES)) {
            $this->_grosor = $grosorNumero;
            return true;
        }

        return false;
    }

    /**
     * No se permite la sobrecarga dinámica de propiedades
     */
    public function __set(string $name, mixed $value): void
    {
        throw new Exception("No se permite crear propiedades dinámicas");
    }
}
