<?php

class ClasesMisPropiedades{
    private $_propiedades = [];

    public mixed $propPublica;
    public mixed $_propPrivada = 25;

    public function __set(string $nombre, mixed $valor): void {
        if ($nombre === '_propPrivada') {
            echo "No se puede sobrescribir la propiedad privada '_propPrivada'.\n";
            return;
        }
        $this->_propiedades[$nombre] = $valor;
    }


    public function __get(string $nombre): mixed {
        return $this->_propiedades[$nombre] ?? null;
    }

    public function __isset(string $nombre): bool {
        return isset($this->_propiedades[$nombre]);
    }

    public function __unset(string $nombre): void {
        if (isset($this->_propiedades[$nombre])) {
            unset($this->_propiedades[$nombre]);
        }
    }

    public function getPropPrivada(): mixed {
        return $this->_propPrivada;
    }



}