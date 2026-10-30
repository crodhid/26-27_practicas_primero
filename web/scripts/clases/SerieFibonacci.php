<?php

class SerieFibonacci implements Iterator
{
    private int $_limite;
    private int $_claveActual;

    public function __construct(int $limite)
    {
        $this->_limite = $limite;
        $this->_claveActual = 0;
    }

    /**
     * Fórmula alternativa
     */
    private function calcular(int $n): int
    {
        $raiz5 = sqrt(5);
        $phi = (1 + $raiz5) / 2;
        $psi = (1 - $raiz5) / 2;

        return (int) round((1 / $raiz5) * pow($phi, $n) - (1 / $raiz5) * pow($psi, $n));
    }

    //Métodos de la interfaz Iterator 

    public function rewind(): void
    {
        $this->_claveActual = 0;
    }

    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }

    public function current(): int
    {
        return $this->calcular($this->_claveActual);
    }

    public function key(): int
    {
        return $this->_claveActual;
    }

    public function next(): void
    {
        $this->_claveActual++;
    }

    /**
     *Al utilizar generador PHP la interpreta de forma diferente, nada mas llamar a yield
     *ya está devolviendo de forma automática su valor dentro
     * @param integer $ultimo
     * @return Generator
     */
    public static function fFibonacci(int $ultimo): Generator
    {
        $anterior = 0;
        $actual = 1;

        for ($i = 0; $i <= $ultimo; $i++) {
            yield $anterior;
            [$anterior, $actual] = [$actual, $anterior + $actual];
        }
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