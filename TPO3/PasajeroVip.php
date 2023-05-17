<?php
class PasajeroVip extends Pasajero
{
    private $nro_viaje_frecuente, $cant_millas;

    public function __construct($dni, $nom, $ape, $tel, $nro_asiento, $nro_ticket, $nro_viaje, $millas){
        parent::__construct($dni, $nom, $ape, $tel, $nro_asiento, $nro_ticket);
        $this->nro_viaje_frecuente = $nro_viaje;
        $this->cant_millas = $millas;
    }

    /**
     * Get the value of nro_viaje_frecuente
     */ 
    public function getNro_viaje_frecuente(){
        return $this->nro_viaje_frecuente;
    }

    /**
     * Set the value of nro_viaje_frecuente
     *
     * @return  self
     */ 
    public function setNro_viaje_frecuente($nro_viaje_frecuente){
        $this->nro_viaje_frecuente = $nro_viaje_frecuente;

        return $this;
    }

    /**
     * Get the value of cant_millas
     */ 
    public function getCant_millas(){
        return $this->cant_millas;
    }

    /**
     * Set the value of cant_millas
     *
     * @return  self
     */ 
    public function setCant_millas($cant_millas){
        $this->cant_millas = $cant_millas;

        return $this;
    }

    public function __toString(){
       $info = parent::__toString();

       return <<<END
        $info
          Nro Viaje Frecuente: $this->nro_viaje_frecuente
          Cantidad Millas Acumuladas: $this->cant_millas
        END;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 35;
        if ($this->getCant_millas() > 300){
            $porcentaje = 30;
            
        }
        return $porcentaje;
    }


}
