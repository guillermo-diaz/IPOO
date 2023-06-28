<?php 
    class ResponsableV {

        private $rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido, $mensajeDeOperacion;

        public function __construct($numEmpleado = null, $numLicencia = null, $nom = null, $ape = null) {
            $this->rnombre = $nom;
            $this->rapellido = $ape;
            $this->rnumeroempleado = $numEmpleado;
            $this->rnumerolicencia = $numLicencia;
        }

        public function getRnombre() {
            return $this->rnombre;
        }

        public function getRapellido() {
            return $this->rapellido;
        }

        public function getRnumeroempleado() {
            return $this->rnumeroempleado;
        }
        
        public function getRnumerolicencia() {
            return $this->rnumerolicencia;
        }
        
        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }
        
        public function setRnombre($nom) {
            $this->rnombre = $nom;
        }

        public function setRapellido($ape) {
            $this->rapellido = $ape;
        }

        public function setRnumeroempleado($numEmpleado) {
            $this->rnumeroempleado = $numEmpleado;
        }
        
        public function setRnumerolicencia($numLicencia) {
            $this->rnumerolicencia = $numLicencia;
        }

        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }
    
        public function cargarDatos($numE, $numL, $nom, $ape) {
            $this->setRnumeroempleado($numE);
            $this->setRnumerolicencia($numL);
            $this->setRnombre($nom);
            $this->setRapellido($ape);
        }
        

        public function buscarDatos($numE) {
            $bD = new BaseDatos();
            $resultado = false;
            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM responsable WHERE rnumeroempleado = '$numE'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $this->cargarDatos($numE, $row['rnumerolicencia'], $row['rnombre'], $row['rapellido']);
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
                $consulta = "SELECT * FROM responsable ";
                if (!empty($condicion)) {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by rnumeroempleado ";
                if ($bD->Ejecutar($consulta)) {
                    while ($row = $bD->Registro()) {
                        $responsable = new ResponsableV();
                        $responsable->cargarDatos($row['rnumeroempleado'], $row['rnumerolicencia'], $row['rnombre'], $row['rapellido']);
                        array_push($coleccion, $responsable);
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
                $consulta = "INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
                VALUES ('".$this->getRnumerolicencia()."','".$this->getRnombre()."','".$this->getRapellido()."')";
                if ($rnumeroempleado = $bD->devuelveIDInsercion($consulta)) {
                    $this->setRnumeroempleado($rnumeroempleado);
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
                $consulta = "UPDATE responsable 
                SET rnombre = '".$this->getRnombre()."', rapellido = '".$this->getRapellido()."', rnumerolicencia = '".$this->getRnumerolicencia()."' 
                WHERE rnumeroempleado = ".$this->getRnumeroempleado();
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
                $consulta = "DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado();
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
            $viajes = $viaje->listar("rnumeroempleado = ".$this->getRnumeroempleado());
            return $viajes;
        }

        public function __toString() {
            return ("Numero de empleado: ".$this->getRnumeroempleado()."\nNumero de licencia: ".$this->getRnumerolicencia().
                "\nNombre: ".$this->getRnombre()."\nApellido: ".$this->getRapellido()."\n");
        }
    }
?>