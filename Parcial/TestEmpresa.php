<?php
    include('Cliente.php');
    include('Venta.php');
    include('Empresa.php');
    include ('Moto.php');
    include('MotoExterior.php');
    include('MotoNacional.php');
    
        //Creo clientes y coleccion de clientes
        $objCliente1 = new Cliente('Guillermo', 'Diaz', false, 'DNI', '1');
        $objCliente2 = new Cliente('Cristopher', 'Ovaillos', false, 'DNI', '2');
        $colClientes = [$objCliente1, $objCliente2];

        //Creo motos y coleccion de motos
        $objMoto1 = new MotoNacional('11', 2230000, 2022, 'Benelli Imperiale 400', 85, true);
        $objMoto1->setPorcentaje_descuento(10); 
        $objMoto2 = new MotoNacional('12', 584000, 2021, 'Zanella Zr 150 Ohc', 70, true); 
        $objMoto2->setPorcentaje_descuento(10); 
        $objMoto3 = new MotoNacional('13', 999900, 2023, 'Zanella Patagonian Eagle 250', 55, false); 

        $objMoto4 = new MotoExterior('14', 12499900, 2020, 'Pitbike Enduro Motocross Apollo Aiii 190cc Plr', 100, true, 'Fracia', 6244400);
        $colMotos = [$objMoto1, $objMoto2, $objMoto3, $objMoto4];

        //Creo empresa
        $objEmpresa = new Empresa('Alta Gama','Av Argentina 123', $colClientes, $colMotos, []);

        //4.test registrarVenta
        $venta1Resultado = $objEmpresa->registrarVenta(['11','12','13', '14'], $objCliente2);
        echo("Venta 1 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta1Resultado."\n \n"); 

        //5.test registrarVenta
        $venta2Resultado = $objEmpresa->registrarVenta(['13', '14'], $objCliente2);
        echo("Venta 2 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta2Resultado."\n \n");

        //6.test registrarVenta
        $venta3Resultado = $objEmpresa->registrarVenta(['14', '2'], $objCliente2);
        echo("Venta 3 realizada al cliente: \n ".$objCliente2->__toString()." \n Monto total de venta: ".$venta3Resultado."\n \n");
        
        /*
        //6.test retornarVentasXCliente
        $ventasCliente1 = $objEmpresa->retornarVentasXCliente($objCliente1->getTipo_documento(),$objCliente1->getNro_documento());
        echo("Ventas realizadas a ".$objCliente1->__toString().": \n ");
        print_r($ventasCliente1);

        //9.test retornarVentasXCliente
        $ventasCliente2 = $objEmpresa->retornarVentasXCliente($objCliente2->getTipo_documento(),$objCliente2->getNro_documento());
        echo("Ventas realizadas a ".$objCliente2->__toString().": \n ");
        print_r($ventasCliente2);*/

        //7. test informarVentasImportadas
        $ventas_importadas = $objEmpresa->informarVentasImportadas();
        echo("Ventas importadas:\n");
        foreach($ventas_importadas as $venta){
            echo "-".$venta->__toString(). "\n\n";
        }

        //8. test informarSumaVentasNacionales() 
        $monto_nacionales = $objEmpresa->informarSumaVentasNacionales();
        echo("\nMonto total ventas nacionales: ".$monto_nacionales);


        //9. echo de empresa
        echo("\n\n Datos de la empresa: \n");
        echo($objEmpresa->__toString());


    
?>