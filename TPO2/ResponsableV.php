<?php
class ResponsableV
{
    private $nombre, $apellido, $nro_empleado, $nro_licencia;

    public function __construct($nom, $ape, $nro_emp, $nro_lic){
        if (!empty($nom) && !empty($ape) && !empty($nro_emp) && !empty($nro_lic)) {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->nro_empleado = $nro_emp;
            $this->nro_licencia = $nro_lic;
        } else {
            throw new ErrorException("Error al crear la clase ResponsableV, datos erroneos");
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
     * Get the value of nro_empleado
     */ 
    public function getNro_empleado(){
        return $this->nro_empleado;
    }

    /**
     * Set the value of nro_empleado
     *
     * @return  self
     */ 
    public function setNro_empleado($nro_empleado){
        $this->nro_empleado = $nro_empleado;

        return $this;
    }

    /**
     * Get the value of nro_licencia
     */ 
    public function getNro_licencia(){
        return $this->nro_licencia;
    }

    //  setNro_licencia no existe xq es clave

    public function __toString(){
        return <<<END
          Nombre: $this->nombre
          Apellido: $this->apellido
          Nro Licencia: $this->nro_licencia
          Nro Empleado: $this->nro_empleado
        END;
    }
}