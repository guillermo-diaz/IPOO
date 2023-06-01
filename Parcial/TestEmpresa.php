<?php
    include('Cliente.php');
    include('Moto.php');
    include('Venta.php');
    include('Empresa.php');
    
        //Creo clientes y coleccion de clientes
        $objCliente1 = new Cliente('Nombre1', 'Apellido1', false, 'DNI', '1');
        $objCliente2 = new Cliente('Nombre2', 'Apellido2', false, 'DNI', '2');
        $colClientes = [$objCliente1, $objCliente2];

        //Creo motos y coleccion de motos
        $objMoto1 = new Moto('11', 2230000, 2022, 'Benelli Imperiale 400', 85, true); //precio 191780000
        $objMoto2 = new Moto('12', 584000, 2021, 'Zanella Zr 150 Ohc', 70, true); // precio 82344000
        $objMoto3 = new Moto('13', 999900, 2023, 'Zanella Patagonian Eagle 250', 55, false); // precio 999900
        $colMotos = [$objMoto1, $objMoto2, $objMoto3];

        //Creo empresa
        $objEmpresa = new Empresa('Alta Gama','Av Argentina 123', $colClientes, $colMotos, []);

        //5.test registrarVenta
        $venta1Resultado = $objEmpresa->registrarVenta(['11','12','13'], $objCliente2);
        echo("Venta 1 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta1Resultado."\n"); //tiene que dar 274124000
        //6.test registrarVenta
        $venta2Resultado = $objEmpresa->registrarVenta([0], $objCliente2);
        echo("Venta 2 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta2Resultado."\n");
        //7.test registrarVenta
        $venta3Resultado = $objEmpresa->registrarVenta([2], $objCliente2);
        echo("Venta 3 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta3Resultado."\n");
        
        //8.test retornarVentasXCliente
        $ventasCliente1 = $objEmpresa->retornarVentasXCliente($objCliente1->getTipo_documento(),$objCliente1->getNro_documento());
        echo("Ventas realizadas a ".$objCliente1->__toString().": \n ");
        print_r($ventasCliente1);

        //9.test retornarVentasXCliente
        $ventasCliente2 = $objEmpresa->retornarVentasXCliente($objCliente2->getTipo_documento(),$objCliente2->getNro_documento());
        echo("Ventas realizadas a ".$objCliente2->__toString().": \n ");
        print_r($ventasCliente2);

        //10. echo de empresa
        echo("Datos de la empresa: \n");
        echo($objEmpresa->__toString());
    
?>