<?php
    class Cliente {
        private $nombre, $apellido, $esta_de_baja, $tipo_documento, $nro_documento;

        public function __construct($nombre, $apellido, $esta_de_baja, $tipo, $nro_documento)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->esta_de_baja = $esta_de_baja;
            $this->tipo_documento = $tipo;
            $this->nro_documento = $nro_documento;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
        }


        public function getEsta_de_baja(){
                return $this->esta_de_baja;
        }

        /**
         * Set the value of esta_de_baja
         *
         * @return  self
         */ 
        public function setEsta_de_baja($esta_de_baja){
                $this->esta_de_baja = $esta_de_baja;

                return $this;
        }

        /**
         * Get the value of nro_documento
         */ 
        public function getNro_documento(){
            return $this->nro_documento;
        }
        /**
         * Get the value of tipo_documento
         */ 
        public function getTipo_documento(){
                return $this->tipo_documento;
        }
        
        /**
         * Set the value of nro_documento
         *
         * @return  self
         */ 
        public function setNro_documento($nro_documento){
                $this->nro_documento = $nro_documento;

                return $this;
        }
        /**
         * Set the value of tipo_documento
         *
         * @return  self
         */ 
        public function setTipo_documento($tipo_documento){
                $this->tipo_documento = $tipo_documento;

                return $this;
        }

        public function __toString() {
                /*Metodo que retorna una cadena con la información de la instancia de Cliente*/
                $cadena = "Nombre: ".$this->getNombre().", Apellido: ".$this->getApellido().", Dado de baja: ".(($this->getEsta_de_baja())?'Si':'No').
                ", Tipo de DNI: ".$this->getTipo_documento().", Numero de DNI: ".$this->getNro_documento();
                return $cadena;
            }

        public function equals($tipo_doc, $nro_doc){
                return $this->getTipo_documento() == $tipo_doc && $this->getNro_documento() == $nro_doc;
        }
    


    }



?>