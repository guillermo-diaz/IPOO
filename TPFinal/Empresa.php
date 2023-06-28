<?php
    class Empresa {

        private $idempresa, $enombre, $edireccion, $mensajeDeOperacion;
        
        public function __construct($ide = null, $enom = null, $edir = null) {
            $this->idempresa = $ide;
            $this->enombre = $enom;
            $this->edireccion = $edir;
        }

     
        public function getIdempresa() {
            return $this->idempresa;
        }

        public function getEnombre() {
            return $this->enombre;
        }

        public function getEdireccion() {
            return $this->edireccion;
        }

        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }

     
        public function setIdempresa($ide) {
            $this->idempresa = $ide;
        }

        public function setEnombre($enom) {
            $this->enombre = $enom;
        }

        public function setEdireccion($edir) {
            $this->edireccion = $edir;
        }

        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }


        public function cargarDatos($ide, $enom, $edir) {
            $this->setIdempresa($ide);
            $this->setEnombre($enom);
            $this->setEdireccion($edir);
        }

    
        public function buscarDatos($ide) {
            $resultado = false;
            $bD = new BaseDatos();


            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM empresa WHERE idempresa = '$ide'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $this->cargarDatos($ide, $row['enombre'], $row['edireccion']);
                        $resultado = true;
                    }
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        public function listar($condicion = "") {
            $coleccion = [];
            $bD = new BaseDatos();


            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM empresa ";
                if (!empty($condicion)) {
                    $consulta = $consulta.' WHERE '.$condicion;
                }

                $consulta .= " order by idempresa ";
                if ($bD->Ejecutar($consulta)) {
                    while ($row = $bD->Registro()) {
                        $empresa = new Empresa();
                        $empresa->cargarDatos($row['idempresa'], $row['enombre'], $row['edireccion']);
                        array_push($coleccion, $empresa);
                    }
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $coleccion;
        }

        public function insertar() {
            $resultado = false;
            $bD = new BaseDatos();

            if ($bD->Iniciar()) {
                $consulta = "INSERT INTO empresa(enombre, edireccion) 
                VALUES ('".$this->getEnombre()."','".$this->getEdireccion()."')";
                if ($idempresa = $bD->devuelveIDInsercion($consulta)) {
                    $this->setIdempresa($idempresa);
                    $resultado = true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

    
        public function modificar() {
            $resultado = false;
            $bD = new BaseDatos();   
            
            
            if ($bD->Iniciar()) {
                $consulta = "UPDATE empresa 
                    SET enombre = '".$this->getEnombre()."', edireccion = '".$this->getEdireccion()."' 
                    WHERE idempresa = ".$this->getIdempresa();
                if ($bD->Ejecutar($consulta)) {
                    $resultado =  true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

      
        public function eliminar() {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
                if ($bD->Ejecutar($consulta)) {
                    $resultado =  true;
                } else {
                    $this->setMensajeDeOperacion($bD->getError());
                }
            } else {
                $this->setMensajeDeOperacion($bD->getError());
            }
            return $resultado;
        }

        public function getViajes() {
            $viaje = new Viaje;
            $viajes = $viaje->listar("idempresa = ".$this->getIdempresa());
            return $viajes;
        }

        public function __toString() {
            return ("Empresa ID: ".$this->getIdempresa().
                "\nNombre: ".$this->getEnombre().
                "\nDireccion: ".$this->getEdireccion()."\n");
        }
    }
?>