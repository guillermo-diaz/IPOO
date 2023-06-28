<?php 
    class Pasajero {

        private $pdocumento;
        private $pnombre;
        private $papellido;
        private $ptelefono;
        private $viaje;
        private $mensajeDeOperacion;

        public function __construct($dni = null, $nom = null, $ape = null, $tel = null, $via = null) {
            $this->pdocumento = $dni;
            $this->pnombre = $nom;
            $this->papellido = $ape;
            $this->ptelefono = $tel;
            $this->viaje = $via;
        }

        public function getPdocumento() {
            return $this->pdocumento;
        }
        
        public function getPnombre() {
            return $this->pnombre;
        }

        public function getPapellido() {
            return $this->papellido;
        }

        public function getPtelefono() {
            return $this->ptelefono;
        }

        public function getViaje() {
            return $this->viaje;
        }
        
        public function getMensajeDeOperacion() {
            return $this->mensajeDeOperacion;
        }

        public function setPdocumento($dni) {
            $this->pdocumento = $dni;
        }
        
        public function setPnombre($nom) {
            $this->pnombre = $nom;
        }

        public function setPapellido($ape) {
            $this->papellido = $ape;
        }

        public function setPtelefono($tel) {
            $this->ptelefono = $tel;
        }

        public function setViaje($via) {
            $this->viaje = $via;
        }
        
        public function setMensajeDeOperacion($mensaje) {
            $this->mensajeDeOperacion = $mensaje;
        }
        
        
        //funciones de BD

        public function cargarDatos($dni, $nom, $ape, $tel, $via) {
            $this->setPdocumento($dni);
            $this->setPnombre($nom);
            $this->setPapellido($ape);
            $this->setPtelefono($tel);
            $this->setViaje($via);
        }

        public function buscarDatos($dni) {
            $bD = new BaseDatos();
            $resultado = false;


            if ($bD->Iniciar()) {
                $consulta = "SELECT * FROM pasajero WHERE pdocumento = '$dni'";
                if ($bD->Ejecutar($consulta)) {
                    if ($row = $bD->Registro()) {
                        $viaje = new Viaje();
                        $viaje->buscarDatos($row['idviaje']);
                        $this->cargarDatos($dni, $row['pnombre'], $row['papellido'], $row['ptelefono'], $viaje);
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
                $consulta = "SELECT * FROM pasajero ";
                if (!empty($condicion)) {
                    $consulta = $consulta.' WHERE '.$condicion;
                }
                $consulta .= " order by pdocumento ";
                if ($bD->Ejecutar($consulta)) {
                    while ($row = $bD->Registro()) {
                        $pasajero = new Pasajero();
                        $viaje = new Viaje();   
                        $viaje->buscarDatos($row['idviaje']);
                        $pasajero->cargarDatos($row['pdocumento'], $row['pnombre'], $row['papellido'], $row['ptelefono'], $viaje);
                        array_push($coleccion, $pasajero);
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
                $consulta = "INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje) 
                VALUES ('".$this->getPdocumento()."','".$this->getPnombre()."','".$this->getPapellido()."',
                '".$this->getPtelefono()."','".($this->getViaje())->getIdviaje()."')";
                if ($bD->Ejecutar($consulta)) {
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
                $consulta = "UPDATE pasajero
                SET pnombre = '".$this->getPnombre()."', papellido = '".$this->getPapellido()."', ptelefono = '".$this->getPtelefono()."', idviaje = '".($this->getViaje())->getIdviaje()."'
                WHERE pdocumento = ".$this->getPdocumento();
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
                $consulta = "DELETE FROM pasajero WHERE pdocumento = ".$this->getPdocumento();
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

        public function __toString() {
            return ("DNI: ".$this->getPdocumento()."\nNombre: ".$this->getPnombre(). 
                "\nApellido: ".$this->getPapellido()."\nTelefono: ".$this->getPtelefono()."\nViaje: ".($this->getViaje())->getIdviaje()."\n");
        }
    }
?>