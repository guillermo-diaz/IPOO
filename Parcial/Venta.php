<?php
    class Venta {
        private $numero, $fecha, $cliente, $col_motos, $precio_final;

        public function __construct($numero, $fecha, $cliente, $col_motos, $precio_final)
        {
            $this->numero = $numero;
            $this->fecha = $fecha;
            $this->cliente = $cliente;
            $this->col_motos = $col_motos;
            $this->precio_final = $precio_final;
        }


        /**
         * Get the value of numero
         */ 
        public function getNumero()
        {
                return $this->numero;
        }

        

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }


        /**
         * Get the value of cliente
         */ 
        public function getCliente()
        {
                return $this->cliente;
        }


        /**
         * Get the value of col_motos
         */ 
        public function getCol_motos()
        {
                return $this->col_motos;
        }

        

        /**
         * Get the value of precio_final
         */ 
        public function getPrecio_final()
        {
                return $this->precio_final;
        }

         /**
         * Set the value of numero
         *
         * @return  self
         */ 
        public function setNumero($numero)
        {
                $this->numero = $numero;

                return $this;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Set the value of cliente
         *
         * @return  self
         */ 
        public function setCliente($cliente)
        {
                $this->cliente = $cliente;

                return $this;
        }

        /**
         * Set the value of col_motos
         *
         * @return  self
         */ 
        public function setCol_motos($col_motos)
        {
                $this->col_motos = $col_motos;

                return $this;
        }

        /**
         * Set the value of precio_final
         *
         * @return  self
         */ 
        public function setPrecio_final($precio_final)
        {
                $this->precio_final = $precio_final;

                return $this;
        }

        public function mostrarMotos(){
            $cad = "";

            foreach ($this->getCol_motos() as $moto) {
                $cad = $cad . $moto->__toString() . " \n";

            }
            return $cad;
        }

        public function __toString() {
                $num = $this->getNumero();
                $fe = $this->getFecha();
                $cli = ($this->getCliente())->__toString();
                $colM = $this->mostrarMotos();
                $precioF = $this->getPrecio_final();
                return <<<END
                    Numero: $num
                    Fecha: $fe
                    Cliente: $cli
                    Motos:
                $colM    Precio final: $precioF
                END;
            }

        public function incorporarMoto($objMoto){
            $flag = false; //para verificar que si se pudo incorporar a la moto a la coleccion
            if ($objMoto->getActiva()){  //no hay manera de que este repetido en la coleccion, ya que si lo estuviera (no estaria activo) por eso no lo verifico
                $motos = $this->getCol_motos();
                $motos[] = $objMoto;
                $this->setCol_motos($motos);
                
                $this->setPrecio_final($this->getPrecio_final() + $objMoto->darPrecioVenta());
                $flag = true;
            }
            return $flag;
        }

       
    }



?>