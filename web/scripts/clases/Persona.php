<?php
require_once 'EstadoCivil.php';
class Persona{
    //Atributos
    private String $_nombre;
    private String $_fecha_nacimiento;
    private String $_domicilio;
    private String $_localidad;
    private EstadoCivil $_estadocivil;


    //Constructores
      private function __construct()
    {
       $this -> _nombre = "prueba";
       $this -> _fecha_nacimiento = "01/01/2000";
       $this -> _domicilio = "carrera 12";
       $this -> _localidad = "Antequera";
       $this -> _estadocivil = EstadoCivil::soltero;
    }

    public static function registraPersona($nombre,$fecha,$domi,$loca,$estado):Persona{
        $p = new Persona();
        $p -> _nombre = $nombre;
        $p -> _fecha_nacimiento = $fecha;
        $p -> _domicilio = $domi;
        $p -> _localidad = $loca;
        $p -> _estadocivil = $estado;
        return $p;
    }
    
    // Getters and Setters
   
    public function get_nombre()
    {
        return $this->_nombre;
    }

   
    public function set_nombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }

    public function get_fecha_nacimiento()
    {
        return $this->_fecha_nacimiento;
    }

  
    public function set_fecha_nacimiento($_fecha_nacimiento)
    {
        $this->_fecha_nacimiento = $_fecha_nacimiento;

        return $this;
    }

    public function get_domicilio()
    {
        return $this->_domicilio;
    }

 
    public function set_domicilio($_domicilio)
    {
        $this->_domicilio = $_domicilio;

        return $this;
    }

    public function get_localidad()
    {
        return $this->_localidad;
    }

  
    public function set_localidad($_localidad)
    {
        $this->_localidad = $_localidad;

        return $this;
    }

    

    public function getEstadocivil()
    {
        return $this->_estadocivil;
    }

  
    public function setEstadocivil($estadocivil)
    {
        $this->_estadocivil = $estadocivil;

        return $this;
    }

    // Metodo toString

    public function __toString() : String{
        return  "$this->_nombre su estadocivil es {$this->_estadocivil->descripcion()}(a) nacida el {$this->_fecha_nacimiento} y que vive en {$this->_localidad}";
    }
}