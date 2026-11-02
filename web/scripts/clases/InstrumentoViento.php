<?php

class InstrumentoViento extends InstrumentoBase
{
    protected string $_material = "madera";

    /**
     * La descripción es fija ("instrumento de viento"), por eso no llega como parámetro.
     * La edad por defecto es 15.
     */
    public function __construct(string $material = "madera", int $edad = 15)
    {
        $this->_material = $material;
        parent::__construct("instrumento de viento", $edad);
    }

    /**
     * Final: las clases derivadas no pueden redefinirlo
     */
    #[Override]
    final public function afinar(): string
    {
        return "Ajustar aire";
    }

    #[Override]
    public function sonido(): string
    {
        return "Es de aire";
    }

    #[Override]
    public function __toString(): string
    {
        return parent::__toString() . ". Instrumento de material " . $this->_material;
    }
}