<?php

class Flauta extends InstrumentoViento implements IFabricable
{
    // Atributo

    // Constructor
    private function __construct()
    {
        parent::__construct();
    }

    //Metodos
    public function metodoFabricacion()
    {
        return "Fabricada con " . $this->_material;
    }

    public function metodoReciclado()
    {
        return "Reciclada separando componentes de " . $this->_material;
    }


    public static function crearDesdeArray(array $array)
    {
        // creamos una nueva flauta
        $flauta = new Flauta();
        // le asignamos el materal en la posicion del array y si no tiene le podemos uno por defecto
        // igual para la edad
        $flauta->_material = $array['material'] ?? 'madera';
        $flauta->_edad = $array['edad'] ?? 0;
        //devolvemos el objeto faluta
        return $flauta;
    }

    public function clonacion() {
        $this-> _edad = 0;
        self::$cont++;
        $this->cont = self::$cont ;
    }

    //  toString
    public function __toString()
    {
        // llamamos al toString del padre
        return parent::__toString();
    }
}