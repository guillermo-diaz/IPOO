<?php 


class MotoExterior extends Moto {
    private $pais, $importe_impuestos;

    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa, $pais, $importe_impuestos)
    {
        parent::__construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa);
        $this->pais = $pais;
        $this->importe_impuestos = $importe_impuestos;

    }

    /**
     * Get the value of pais
     */ 
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */ 
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get the value of importe_impuestos
     */ 
    public function getImporte_impuestos()
    {
        return $this->importe_impuestos;
    }

    /**
     * Set the value of importe_impuestos
     *
     * @return  self
     */ 
    public function setImporte_impuestos($importe_impuestos)
    {
        $this->importe_impuestos = $importe_impuestos;

        return $this;
    }

    public function __toString()
    {
        return parent::__toString().", Pais: ".$this->getPais().", Importe impuestos: ".$this->getImporte_impuestos();
    }

    public function darPrecioVenta()
    {
        $precio = parent::darPrecioVenta();
        if ($precio > 0){ //si esta a la venta
            $precio = $precio + $this->getImporte_impuestos(); //le sumo el importe
        }
        return $precio; 
    }

   
}



?>