<?php
class Viaje{
  private $codigo, $destino, $max_pasajeros, $pasajeros;

  public function  __construct($codigo, $destino, $max_pasajeros, $pasajeros){
    if (!empty($codigo) && !empty($destino) && ($max_pasajeros >= count($pasajeros))){
      $this->codigo = $codigo;
      $this->destino = $destino;
      $this->max_pasajeros = $max_pasajeros;
      $this->pasajeros = $pasajeros;
    } else{
      throw new ErrorException("Error al crear la clase viaje, datos erroneos");
      
    }
   
  }

  /**
   * Get the value of codigo
   */
  public function getCodigo(){
    return $this->codigo;
  }


  /**
   * Get the value of destino
   */
  public function getDestino(){
    return $this->destino;
  }

  /**
   * Set the value of destino
   *
   */
  public function setDestino($destino){
    $this->destino = $destino;
  }

  /**
   * Get the value of max_pasajeros
   */
  public function getMax_pasajeros(){
    return $this->max_pasajeros;
  }

  /**
   * Set the value of max_pasajeros
   *
   */
  public function setMax_pasajeros($max_pasajeros){
    $flag = false;

    /*Si estoy intentando cambiar el tamaño maximo y este resulta menor
    a la cant actual de pasajeros, retorno false
    */
    if ($max_pasajeros >= count($this->pasajeros)){
      $this->max_pasajeros = $max_pasajeros;
      $flag = true;
    }

    return $flag;
  }

  /**
   * Get the value of pasajeros
   */
  public function getPasajeros(){
    return $this->pasajeros;
  }

  /**
   * Set the value of pasajeros
   *
   */
  public function setPasajeros($pasajeros){
    $flag = false; 
    if (count($pasajeros) <= $this->max_pasajeros){
      $this->pasajeros = $pasajeros;
      $flag = true;
    }
    return $flag;
  }

  public function setPasajerosConLimite($pasajeros, $limite){
    $this->max_pasajeros = $limite;
    return $this->setPasajeros($pasajeros);
  }

  public function agregar_pasajero($pas){
    $flag = false;
    $pos = count($this->pasajeros);
    if ($pos + 1 < $this->max_pasajeros){
      $this->pasajeros[$pos] = $pas;
      $flag = true;
    }
    return $flag;
  }

  public function set_nombre_pasajero($dni_pasajero, $nombre){
    $flag = false;
    $i = 0;
    $max = count($this->pasajeros);

    while (!$flag && $i < $max){
      
      if ($this->pasajeros[$i]['DNI'] == $dni_pasajero){
        $this->pasajeros[$i]['nombre'] = $nombre;
        $flag = true;
      } else{
        $i++;
      }
    }
    return $flag;
  }

  public function set_apellido_pasajero($dni_pasajero, $apellido){
    $flag = false;
    $i = 0;
    $max = count($this->pasajeros);

    while (!$flag && $i < $max){
      
      if ($this->pasajeros[$i]['DNI'] == $dni_pasajero){
        $this->pasajeros[$i]['apellido'] = $apellido;
        $flag = true;
      } else{
        $i++;
      }
    }
    return $flag;
  }

  public function __toString(){
    $pasajeros_actual = count($this->pasajeros);
		return <<<END
    Codigo: $this->codigo 
    Destino: $this->destino 
    Cantidad actual de pasajeros: $pasajeros_actual 
    Cantidad máxima de pasajeros: $this->max_pasajeros
    
    END;
	}

  
}
