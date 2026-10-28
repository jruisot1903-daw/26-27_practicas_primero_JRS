<?php

/**
 * Clase InstrumentoViento es una clase expecifica para los instrumentos de viento
 * Para crearlo tenemos que pasarle al constructor el material y la edad
 * Si no le pasamos nada por defeto sera de Madera y tendra 15 años
 */
class InstrumentoViento extends InstrumentoBase{
    // Atributo
    protected string $_material = "madera";

    // Constructor
    public function __construct(string $material = "madera", int $edad = 15) {
        parent::__construct("instrumento de viento", $edad);
        $this->_material = $material;
    }

    //Metodos

    public function sonido() {
        return "Suena al soplar aire a través de la boquilla del instrumento.";
    }

    final public function afinar() {
        return "Se afina ajustando la presión del aire y la posición de las llaves.";
    }

    //  toString
    public function __toString(): string {
        return parent::__toString() . "Material: " . $this->_material . "<br>";
    }
}