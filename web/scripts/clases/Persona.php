<?php

class Persona
{

    private string $_nombre, $_fecha_nacimiento, $_domicilio, $_localidad;
    private EstadoCivil $_estado;

    /**
     * Constructor privado sin parámetros: rellena con valores de prueba
     */
    private function __construct()
    {
        $this->_nombre = "prueba";
        $this->_fecha_nacimiento = "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad = "antequera";
        $this->_estado = EstadoCivil::soltero;
    }

    // GETTERS
    public function getNombre(): string
    {
        return $this->_nombre;
    }
    public function getFechaNacimiento(): string
    {
        return $this->_fecha_nacimiento;
    }
    public function getDomicilio(): string
    {
        return $this->_domicilio;
    }
    public function getLocalidad(): string
    {
        return $this->_localidad;
    }
    public function getEstado(): EstadoCivil
    {
        return $this->_estado;
    }

    // SETTERS
    public function setNombre(string $nombre): void
    {
        $this->_nombre = $nombre;
    }
    public function setFechaNacimiento(string $fecha): void
    {
        $this->_fecha_nacimiento = $fecha;
    }
    public function setDomicilio(string $domicilio): void
    {
        $this->_domicilio = $domicilio;
    }
    public function setLocalidad(string $localidad): void
    {
        $this->_localidad = $localidad;
    }
    public function setEstado(EstadoCivil $estado): void
    {
        $this->_estado = $estado;
    }

    /**
     * Constructor estático con todas las propiedades
     */
    public static function registrarPersona(string $nombre, string $fecha, string $domicilio, string $localidad, EstadoCivil $estado): Persona
    {
        $persona = new Persona();
        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);

        return $persona;
    }

    public function __toString(): string
    {
        return $this->_nombre . " es una persona " . $this->_estado->descripcion()
            . " nacida en " . $this->_fecha_nacimiento
            . " y que vive en " . $this->_localidad;
    }

    //Desactivamos los métodos mágicos
    public function __get(string $nombre): mixed
    {
        throw new LogicException("No se puede acceder a la propiedad $nombre");
    }

    public function __set(string $nombre, mixed $valor): void
    {
        throw new LogicException("No se puede asignar la propiedad $nombre");
    }

    public function __isset(string $nombre): bool
    {
        return false;
    }

    public function __unset(string $nombre): void
    {
        throw new LogicException("No se puede eliminar la propiedad $nombre");
    }
}
