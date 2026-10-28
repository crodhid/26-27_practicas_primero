<?php

class Flauta extends InstrumentoViento implements IFabricable
{

    #[Override]
    private function __construct(string $material, int $edad = 15)
    {
        return parent::__construct($material, $edad);
    }

    //Constructor estático en el que puede o no aparecer posiciones del array
    public static function crearDesdeArray(array $datos): Flauta
    {
        //esto esta haciendo que si no tiene ese valor de material dentro del array se le introduce madera
        $material = $datos["material"] ??  "Madera";

        //Lo mismo pasa aquí en edad
        $edad = $datos["edad"] ?? 15;
        //Creo un objeto de flauta con esos datos y los devuelvo
        $instancia = new Flauta($material, $edad);
        return $instancia;
    }

    //Función para clonar mi objeto flauta
    public function __clone()
    {
        $this->_edad = 0;
        self::$_contador++;
        $this->_orden = self::$_contador;
    }
}
