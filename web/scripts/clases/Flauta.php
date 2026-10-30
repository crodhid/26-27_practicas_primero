<?php

/**
 * Clase final: no se puede heredar de ella
 */
final class Flauta extends InstrumentoViento implements IFabricable
{
    private function __construct(string $material = "madera", int $edad = 15)
    {
        parent::__construct($material, $edad);
    }

    /**
     * Constructor estático. "material" y "edad" pueden no aparecer en el array
     */
    public static function crearDesdeArray(array $datos): Flauta
    {
        $material = $datos["material"] ?? "madera";
        $edad = $datos["edad"] ?? 15;

        if (!is_string($material) || !is_int($edad)) {
            throw new InvalidArgumentException("El material debe ser texto y la edad un entero");
        }

        return new self($material, $edad);
    }

    /**
     * Al clonar: mismos valores, pero edad 0 y nuevo número de instancia
     */
    public function __clone()
    {
        $this->_edad = 0;
        self::$_contador++;
        $this->_orden = self::$_contador;
    }

    #[Override]
    public function metodoFabricacion(): string
    {
        return "Se corta y se vacía el material, se perforan los orificios de las notas y se pule";
    }

    #[Override]
    public function metodoReciclado(): string
    {
        return "Si es de madera se tritura para aglomerado; si es de metal se funde";
    }
}