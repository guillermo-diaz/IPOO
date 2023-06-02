<?php 


class MotoNacional extends Moto {
    private $porcentaje_descuento;

    public function __construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa)
    {
        parent::__construct($codigo, $costo, $anio_fabricacion, $descripcion, $porcentaje_incremento_anual, $activa);
        $this->porcentaje_descuento = 15;

    }

    /**
     * Get the value of porcentaje_descuento
     */ 
    public function getPorcentaje_descuento()
    {
        return $this->porcentaje_descuento;
    }

    /**
     * Set the value of porcentaje_descuento
     *
     * @return  self
     */ 
    public function setPorcentaje_descuento($porcentaje_descuento)
    {
        $this->porcentaje_descuento = $porcentaje_descuento;

        return $this;
    }

    public function __toString()
    {
        return parent::__toString().", Porcentaje de descuento: ".$this->getPorcentaje_descuento();
    }

    public function darPrecioVenta()
    {
        $precio = parent::darPrecioVenta();
        if ($precio > 0){ //si esta a la venta
            $precio = $precio - $precio*($this->getPorcentaje_descuento()/100);
        }
        return $precio; 
    }

    


}




?>