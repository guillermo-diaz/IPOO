<?php
class PasajeroNE extends Pasajero
{
    private $cant_necesidades;

    public function __construct($dni, $nom, $ape, $tel, $nro_asiento, $nro_ticket, $cant_ne){
        parent::__construct($dni, $nom, $ape, $tel, $nro_asiento, $nro_ticket);
        $this->cant_necesidades = $cant_ne;
    }
    
    /**
     * Get the value of cant_necesidades
     */ 
    public function getCant_necesidades()
    {
        return $this->cant_necesidades;
    }

    /**
     * Set the value of cant_necesidades
     *
     * @return  self
     */ 
    public function setCant_necesidades($cant_necesidades)
    {
        $this->cant_necesidades = $cant_necesidades;
        
        return $this;
    }
    public function __toString(){
       $info = parent::__toString();
    
       return <<<END
        $info
          Cantidad necesidades especiales: $this->cant_necesidades 
        END;
    }
    
    public function darPorcentajeIncremento(){
        $porcentaje = 15;
        if ($this->getCant_necesidades() > 1){
            $porcentaje = 30;
            
        }
        return $porcentaje;
    }
}