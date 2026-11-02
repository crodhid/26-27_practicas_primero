<?php

/**
 * ClaseMisPropiedades
 *
 * Permite añadir propiedades dinámicas en tiempo de ejecución
 * y se puede recorrer con foreach. No usa excepciones ni avisos.
 */
class ClaseMisPropiedades implements IteratorAggregate
{
    // Array donde se guardan las propiedades dinámicas
    // ['propiedad1' => 25, 'propiedad2' => 'cadena de texto']
    private array $_propiedades = [];

    // Propiedad pública normal: no pasa por los métodos mágicos
    public mixed $propPublica = null;

    // Propiedad privada inicializada a 25
    private mixed $_propPrivada = 25;

    /**
     * __set: PHP lo ejecuta al ASIGNAR una propiedad que no existe
     * o que no es accesible desde fuera.
     */
    public function __set(string $nombre, mixed $valor): void
    {
        // Si intentan asignar la privada (o el array interno),
        // salimos sin guardar nada. La asignación se ignora.
        if ($nombre === '_propPrivada' || $nombre === '_propiedades') {
            return;
        }

        // En cualquier otro caso, se guarda como propiedad dinámica
        $this->_propiedades[$nombre] = $valor;
    }

    /**
     * __get: PHP lo ejecuta al LEER una propiedad que no existe
     * o que no es accesible desde fuera.
     */
    public function __get(string $nombre): mixed
    {
        // Si existe en el array dinámico, devolvemos su valor
        if (array_key_exists($nombre, $this->_propiedades)) {
            return $this->_propiedades[$nombre];
        }

        // Si no existe (o es privada), devolvemos false
        return false;
    }

    /** __isset: hace que isset($obj->prop) funcione con las dinámicas */
    public function __isset(string $nombre): bool
    {
        return isset($this->_propiedades[$nombre]);
    }

    /** __unset: hace que unset($obj->prop) funcione con las dinámicas */
    public function __unset(string $nombre): void
    {
        unset($this->_propiedades[$nombre]);
    }

    /**
     * getIterator: PHP lo llama en el foreach. Es un generador (yield).
     * Orden: dinámicas, después propPublica y _propPrivada, todas con "oi_".
     */
    public function getIterator(): Iterator
    {
        foreach ($this->_propiedades as $clave => $valor) {
            yield "oi_" . $clave => $valor;
        }

        yield "oi_propPublica" => $this->propPublica;
        yield "oi__propPrivada" => $this->_propPrivada;
    }
}