<?php
class Moto{
    private $codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa;

    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa)
    {
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anio_fabricacion = $anio_fabricacion;
        $this->descripcion = $descripcion;
        $this->porcentaje_incremento_anual = $porcentaje_incremento_anual;
        $this->activa = $activa;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    

    /**
     * Get the value of costo
     */ 
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costo
     *
     * @return  self
     */ 
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of anio_fabricacion
     */ 
    public function getAnio_fabricacion()
    {
        return $this->anio_fabricacion;
    }

    /**
     * Set the value of anio_fabricacion
     *
     * @return  self
     */ 
    public function setAnio_fabricacion($anio_fabricacion)
    {
        $this->anio_fabricacion = $anio_fabricacion;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of porcentaje_incremento_anual
     */ 
    public function getPorcentaje_incremento_anual()
    {
        return $this->porcentaje_incremento_anual;
    }

    /**
     * Set the value of porcentaje_incremento_anual
     *
     * @return  self
     */ 
    public function setPorcentaje_incremento_anual($porcentaje_incremento_anual)
    {
        $this->porcentaje_incremento_anual = $porcentaje_incremento_anual;

        return $this;
    }

    /**
     * Get the value of activa
     */ 
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set the value of activa
     *
     * @return  self
     */ 
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }


    public function __toString() {
        return "Codigo: ".$this->getCodigo().", Costo: ".$this->getCosto().", Anio: ".$this->getAnio_fabricacion().", Descripcion: ".$this->getDescripcion().
        ", Porcentaje de incremento anual: ".$this->getPorcentaje_incremento_anual().", Esta activa: ".(($this->activa)?"Si":"No");

    }
    public function darPrecioVenta(){
        $precio = -1;

        if ($this->getActiva()){
            //Considere a 2023 el año actual, no conozco una funcion para que me de el año actual
            $precio = $this->getCosto() + $this->getCosto()*((intval(date('Y'))- $this->getAnio_fabricacion()) * $this->getPorcentaje_incremento_anual());
        }
        return $precio;
    }

    /**
     * Verifica si tiene el mismo codigo
     * @param codigo cualquiera
     * @return boolean son iguales
     */
    public function equals_codigo($un_codigo){
        return $this->getCodigo() == $un_codigo;
    }

    
}



?>