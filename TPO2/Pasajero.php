<?php
class Pasajero
{
    private $nombre, $apellido, $dni, $telefono;

    public function __construct($dni, $nom, $ape, $tel){
        if (!empty($nom) && !empty($ape) && !empty($dni)) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->dni = $dni;
            $this->telefono = $tel;
        } else {
            throw new ErrorException("Error al crear la clase Pasajero, datos erroneos");
        }
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido){
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of dni
     */
    public function getDni(){
        return $this->dni;
    }


    /**
     * Get the value of telefono
     */
    public function getTelefono(){
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono){
        $this->telefono = $telefono;

        return $this;
    }

    public function equals_dni($un_dni){
        return $this->dni == $un_dni;
    }

    public function equals($otro_pasajero){
        return $this->dni == $otro_pasajero->getDni();
    }

    public function __toString(){
        return <<<END
          Nombre: $this->nombre
          Apellido: $this->apellido
          DNI: $this->dni
          Telefono: $this->telefono
        END;
    }



}
