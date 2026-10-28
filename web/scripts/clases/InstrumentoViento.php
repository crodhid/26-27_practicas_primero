<?php

class InstrumentoViento extends InstrumentoBase
{
    protected string $_material;

    /**
     * Consctructor que hereda de la clase padre, mi descripción es "instrumento de viento"
     * entonces no le llega como parámetro, y la edad pasa a ser por defecto 15
     *
     * @param integer $edad
     */
    #[Override]
    function __construct(string $material, int $edad = 15)
    {
        $this->_material = $material;
        parent::__construct("Instrumento de viento", $edad);
    }

    /**
     * Método final en el cual no se puede redefinir mas
     *
     * @return string
     */
    public final function afinar(): string
    {
        return "Ajustar aire";
    }

    #[Override]
    public function sonido(): string {
        return "Es de aire";
    }

    #[Override]
    public function __toString(): string
    {
        return parent::__toString() . " Instrumento de material" . $this->_material;
    }


}
