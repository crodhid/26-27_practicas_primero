<?php

class Persona{
    //Variables de instancia
    private string $_nombre, $_fechaNacimiento, $_domicilio, $_localidad;
    private EstadoCivil $_estadoCivil;

    //Constructor privado en el cual le asigno a mis variables valores a mano ya que el constructor es
    //privado
    private function __construct()
    {
        $this->_nombre = "Prueba";
        $this->_fechaNacimiento= "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad= "Antequera";
        $this->_estadoCivil= EstadoCivil::soltero;
    }

    //GETTER AND SETTER
    public function getNombre():string{
        return $this->_nombre;
    }

    public function getFechaNacimiento():string{
        return $this->_fechaNacimiento;
    }

    public function getDomicilio():string{
        return $this->_domicilio;
    }

    public function getLocalidad():string{
        return $this->_localidad;
    }

    public function getEstadoCivil():EstadoCivil{
        return $this->_estadoCivil;
    }
}