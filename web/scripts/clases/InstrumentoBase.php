<?php

/**
 * Clase InstrumentoBase La vamos a utilizar como plantilla para los intrumentos que crearemos posteriormente.
 * Para crearlo tenemos que pasarle la descripción del dicho instrumento en un STRING y la edad es opcional que
 * se la pasemos , si no le pasamos la edad por defecto sera 10.
 */

abstract class InstrumentoBase{
    //Declaramos el atributo tipo cadena y edad
    private  string $_descripcion;
    protected int $_edad = 10;


    //Declaracion cont de cuantos se han creado
    protected static int $cont = 0; // tenemos que volverlo statica ya que sera la que lleve la cuenta global
    public int $instancia = 0; 

    // Constructores

     public function __construct(string $_descripcion , int $_edad = 10)
    {
        $this->_descripcion = $_descripcion;
        $this-> _edad = $_edad;
        self::$cont++; // Le sumamos uno al contador global           
        $this->instancia = self::$cont; // le asignamos el valor del contador al numero del intrumento creado
    }

    // Le creo el get y el set de la propiedad descripcion y edad el get

    //Getters and Setters

    public function getDescripcion(){
        return $this->  _descripcion;
    }

    public function setDescripcion($descripcion){
        $this->_descripcion = $descripcion;
    }

     public function getEdad(){
        return $this -> _edad;
    }

    // le quitamos la sobrecarga
     public function __set(string $name, mixed $value): void {
        throw new \Exception("No se permite la sobrecarga. La propiedad '{$name}' no existe.");
    }

    public function __get(string $name): mixed {
        throw new \Exception("Intento de leer la propiedad no definida '{$name}'.");
    }


    // Metodos
   abstract public function sonido();

   abstract public function afinar();

    public function envejecer(){
        $this->_edad++;
    }


    //Metodo "toString"
    public function __toString(): string{
        return "<br>Instrumento con descripción  ".$this-> _descripcion.", instancia ".$this->instancia." de un total de ".self::$cont." .Tiene ".$this->_edad." año(s). La clase es ". get_class($this)."<br>";
    }

}