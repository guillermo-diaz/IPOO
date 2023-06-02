<?php


    class Empresa {
        private $denominacion, $direccion, $col_clientes, $col_motos, $col_ventas_realizadas;

        public function __construct($denom, $direc, $colClientes, $colMotos, $colVentas) {
            $this->denominacion = $denom;
            $this->direccion = $direc;
            $this->col_clientes = $colClientes;
            $this->col_motos = $colMotos;
            $this->col_ventas_realizadas = $colVentas;
        }

        /**
         * Get the value of denominacion
         */ 
        public function getDenominacion()
        {
                return $this->denominacion;
        }

        /**
         * Get the value of direccion
         */ 
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Get the value of col_clientes
         */ 
        public function getCol_clientes()
        {
                return $this->col_clientes;
        }

        /**
         * Get the value of col_motos
         */ 
        public function getCol_motos()
        {
                return $this->col_motos;
        }

        /**
         * Get the value of col_ventas_realizadas
         */ 
        public function getCol_ventas_realizadas()
        {
                return $this->col_ventas_realizadas;
        }

        /**
         * Set the value of col_clientes
         *
         * @return  self
         */ 
        public function setCol_clientes($col_clientes)
        {
                $this->col_clientes = $col_clientes;

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
         * Set the value of col_ventas_realizadas
         *
         * @return  self
         */ 
        public function setCol_ventas_realizadas($col_ventas_realizadas)
        {
                $this->col_ventas_realizadas = $col_ventas_realizadas;

                return $this;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */ 
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }

        /**
         * Set the value of denominacion
         *
         * @return  self
         */ 
        public function setDenominacion($denominacion)
        {
                $this->denominacion = $denominacion;

                return $this;
        }

        public function mostrarClientes(){
            $cad = "";

            foreach ($this->getCol_clientes() as $cliente) {
                $cad = $cad . "\t".$cliente->__toString(). " \n";

            }
            return $cad;
        }

        public function mostrarMotos(){
            $cad = "";

            foreach ($this->getCol_motos() as $moto) {
                $cad = $cad . "\t".$moto->__toString() . " \n";

            }
            return $cad;
        }

        public function mostrarVentas(){
            $cad = "";

            foreach ($this->getCol_ventas_realizadas() as $venta) {
                $cad = $cad . $venta->__toString() . " \n";

            }
            return $cad;
        }

        public function __toString() {
            $info_clientes = $this->mostrarClientes();
            $info_motos = $this->mostrarMotos();
            $info_ventas = $this->mostrarVentas();
            $dir = $this->getDireccion();
            $denom = $this->getDenominacion();
            return <<<END
                Denominacion: $denom
                Direccion:  $dir
                Clientes: 
            $info_clientes
                Motos para vender:
            $info_motos
                Ventas realizadas: 
            $info_ventas
            END;
        }

        public function retornarMoto($codigo_moto){
            $moto = null;
            $i = 0;
 

            while ($moto == null && $i < count($this->getCol_motos())){
                $moto_aux = $this->getCol_motos()[$i];

                if ($moto_aux->equals_codigo($codigo_moto)){
                    $moto = $moto_aux; //moto encontrada
                } else {
                    $i++;
                }
            }
            return $moto;
        }

        public function registrarVenta($col_codigos_moto, $objCliente){
            $importe_final = -1; //valor default por si no se pudo realizar la venta

            if (!$objCliente->getEsta_de_baja()){ //si el cliente no esta de baja puede comprar
                $col_motos_venta = [];
                //creo la venta con un codigo random, la fecha actual y los demás datos
                $venta_aux = new Venta(random_int(0, 1000), date('d-m-Y'), $objCliente, $col_motos_venta, 0);
                foreach ($col_codigos_moto as $codigo) {
                    $moto = $this->retornarMoto($codigo);
                    if ($moto != null){ //si la moto existe
                        $venta_aux->incorporarMoto($moto); //approvecho a usar el metodo para incorporar y actualizar el precio
                    }
                }

                if (!empty($venta_aux->getCol_motos())){ //si existe al menos 1 moto que pudo comprar se registra la venta
                    $venta_realizadas = $this->getCol_ventas_realizadas(); //obtengo la col ventas realizadas
                    $venta_realizadas[] = $venta_aux;  //le agrego la nueva venta
                    $this->setCol_ventas_realizadas($venta_realizadas); //actualizo la col de ventas 
                    $importe_final = $venta_aux->getPrecio_final();

                }
            }

            return $importe_final;
            
        }

        /*metodo que retorna la coleccion de ventas de un cliente
        */
        public function ventas_de_cliente($objCliente){
            $ventas = []; //retorna una col vacia si el cliente no tiene ninguna venta

            foreach ($this->getCol_ventas_realizadas() as $venta){
                $cliente = $venta->getCliente();
                if ($objCliente->equals($cliente->getTipo_documento(), $cliente->getNro_documento())){
                    $ventas[] = $venta;
                }
            }
            return $ventas;
        }

        public function devolver_cliente($tipo_doc, $num_doc) {
            $cliente = null;
            $i = 0;
            while ($cliente == null && $i < count($this->getCol_clientes())){
                $aux = $this->getCol_clientes()[$i];
                if ($aux->equals($tipo_doc, $num_doc)){
                    $cliente = $aux;
                } else {
                    $i++;
                }
            }
            return $cliente;
        }

        public function retornarVentasXCliente($tipo_doc, $num_doc){
            $col_ventas = null; //retorna null si el cliente no está en la empresa
            $cliente = $this->devolver_cliente($tipo_doc, $num_doc);

            if ($cliente != null){
                $col_ventas = $this->ventas_de_cliente($cliente);
            }

            return $col_ventas;
        }

        public function informarSumaVentasNacionales(){
            $importe_total_nacionales = 0;

            foreach ($this->getCol_ventas_realizadas() as $venta) {
                //le sumo el total de la venta nacional (si no tiene ninguna moto, suma 0)
                $importe_total_nacionales = $importe_total_nacionales + $venta->retornarTotalVentaNacional();
            }
            return $importe_total_nacionales;
        }

        public function informarVentasImportadas(){
            $col_ventas_importadas = [];

            foreach ($this->getCol_ventas_realizadas() as $venta) {
                //si tiene al menos 1 moto, lo agrego
                if (!empty($venta->retornarMotosImportadas())){ 
                    $col_ventas_importadas[] = $venta;
                }
            }
            return $col_ventas_importadas;
        }
        
    }

?>