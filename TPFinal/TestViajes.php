<?php
    include_once "BaseDatos.php";
    include_once "Empresa.php";
    include_once "Viaje.php";
    include_once "ResponsableV.php";
    include_once "Pasajero.php";

    
    main();

    function main() {
        $sigue = true;
        while ($sigue) {
            opciones();
            echo("Ingrese una opcion: ");
            $caso = trim(fgets(STDIN));
            echo("\n");
            switch ($caso) {
                case 1:
                    abm_pasajeros();
                    break;
                case 2:
                    abm_responsable();
                    break;
                case 3:
                    abm_viaje();
                    break;
                case 4:
                    abm_empresa();
                    break;
                case 5:
                    verEmpresas();
                    break;
                case 6:
                    verResponsables();
                    break;
                case 7:
                    verViajes();
                    break;
                case 8:
                    verPasajeros();
                    break;               
                case 0:
                    $sigue = false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
            echo("\n");
        }
    }

    
    /**
     * Muestra un string con las opciones disponibles
     */
    function opciones() {
        echo (<<<END
        --------------------------------- Menu ---------------------------------
        ABM:
        1) ABM Pasajero 
        2) ABM Responsable 
        3) ABM Viaje 
        4) ABM Empresa
        
        Listar:
        5) Ver empresas              
        6) Ver responsables        
        7) Ver viajes              
        8) Ver pasajeros

        0) Salir
        ------------------------------------------------------------------------ \n
        END);
    }
    
    function opciones_abm(){
        $azul = "\033[31m";
        $reset = "\033[0m";

        echo (<<<END
        $azul---------------------
        1) Insertar
        2) Eliminar
        3) Modificar
        4) Salir 
        ---------------------$reset\n
        END);
    }

    function pedir_documento(){
        echo("Ingrese el nro documento: ");
        $doc = trim(fgets(STDIN));
        return $doc;
    }


    
    function abm_pasajeros(){
        $azul = "\033[31m";
        $reset = "\033[0m";

        $flag = true;
        while ($flag){
            echo($azul."ABM Pasajeros\n".$reset);
            opciones_abm();
            $pasajero = new Pasajero();
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 1:
                    echo($azul."Insertar Pasajero \n".$reset);
                    $doc = pedir_documento();

                    //si no está ya en la base de datos
                    if (!$pasajero->buscarDatos($doc)) {
                        
                        echo("Ingrese un ID de los siguientes viajes: \n");
                        verViajes();
                        $id_viaje = trim(fgets(STDIN));

                        $viaje = new Viaje();
                        
                        if ($viaje->buscarDatos($id_viaje)){
                            $col_pasajeros = $viaje->getPasajeros();
                            if (count($col_pasajeros) < $viaje->getVcantmaxpasajeros()){
                                echo("Ingrese el nombre: ");
                                $nombre = trim(fgets(STDIN));
                                echo("Ingrese el apellido: ");
                                $apellido = trim(fgets(STDIN));
                                echo("Ingrese el telefono: ");
                                $telefono = trim(fgets(STDIN));
                                
                                $pasajero->cargarDatos($doc, $nombre, $apellido, $telefono, $viaje);
                                if ($pasajero->insertar()) {
                                    echo("Pasajero ingresado exitosamente");
                                } else {
                                    echo("ERROR: Datos erroneos");
                                }
                            } else {
                                echo("ERROR: Viaje lleno");
                            }
                        } else {
                            echo("ERROR: Viaje inexistente");
                        }
                    } else{
                        echo("ERROR: Pasajero ya existe en la BD \n");
                    }
                    
                
                    break;
                case 2:
                    echo($azul."Eliminar Pasajero \n".$reset);
                    echo("Lista: \n");
                    verPasajeros();
                    $doc = pedir_documento();
                
                    if ($pasajero->buscarDatos($doc)){
                        $pasajero->eliminar();
                        echo("Pasajero eliminado exitosamente");
                    } else {
                        echo("Pasajero no encontrado \n");
                    }

                    break;
                case 3:
                    echo($azul."Modificar Pasajero \n".$reset);
                    $doc = pedir_documento();
                    
                    if ($pasajero->buscarDatos($doc)){
                        echo("Ingrese el nuevo ID de los siguientes viajes: \n");
                        verViajes();
                        $id_viaje = trim(fgets(STDIN));
                        $viaje = new Viaje();

                        if ($viaje->buscarDatos($id_viaje)) {
                            $col_pasajeros = $viaje->getPasajeros();
                            if (count($col_pasajeros) < $viaje->getVcantmaxpasajeros()){ 
                                echo("\nIngrese el nuevo nombre: ");
                                $nombre = trim(fgets(STDIN));
                                echo("\nIngrese el nuevo apellido: ");
                                $apellido = trim(fgets(STDIN));
                                echo("\nIngrese el nuevo telefono: ");
                                $telefono = trim(fgets(STDIN));
                                $pasajero->cargarDatos($doc, $nombre, $apellido, $telefono, $viaje);
                                if($pasajero->modificar()) {
                                    echo("Pasajero modificado exitosamente");
                                } else {
                                    echo("ERROR: Datos Erroneos");
                                }
                            } else {
                                echo("ERROR: Viaje lleno");
                            }
                        } else {
                            echo("ERROR: Viaje inexistente");
                        }
                    } else {
                        echo("ERROR: Pasajero no encontrado \n");
                    }
                    break;               
                case 4:
                    $flag= false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
            echo("\n");
        }
        echo("\n");
    }

    function pedir_nro_empleado(){
        echo("Ingrese el nro de empleado: ");
        $nro = trim(fgets(STDIN));
        return $nro;
    }

    function abm_responsable(){
        $azul = "\033[31m";
        $reset = "\033[0m";
        $flag = true;

        while ($flag){
            echo($azul."ABM Responsables  \n".$reset);
            opciones_abm();
            $responsable = new ResponsableV();
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 1:
                    echo($azul."Ingresar Responsable\n".$reset);
                    echo("Ingrese el nro de licencia: ");
                    $nro_licencia = trim(fgets(STDIN));
                    echo("Ingrese el nombre: ");
                    $nombre = trim(fgets(STDIN));
                    echo("Ingrese el apellido: ");
                    $apellido = trim(fgets(STDIN));
                    $responsable->cargarDatos(null, $nro_licencia, $nombre, $apellido);
                    if ($responsable->insertar()) {
                        echo "Responsable ingresado exitosamente\n";
                    } else {
                        echo("ERROR: Datos erroneos");
                    }
                    break;
                case 2:
                    echo($azul."Eliminar Responsable\n".$reset);
                    $nro_empleado = pedir_nro_empleado();
                    $resultado = $responsable->buscarDatos($nro_empleado);

                    if ($resultado){
                        $viajes = $responsable->getViajes();
                        
                        if (count($viajes) > 0){
                            echo("ERROR: Debe eliminar primero los siguientes viajes relacionados a el responsable\n");
                            foreach ($viajes as $v) {
                                echo("- ".$v->getIdviaje()."\n");
                            } 
                        } else {
                            echo("Responsable eliminado exitosamente\n");
                            $responsable->eliminar();
                        }

                    } else {
                        echo("ERROR: Responsable no encontrado \n");
                    }
                    break;
                case 3:
                    echo($azul."Modificar Responsable \n".$reset);
                    $nro_empleado = pedir_nro_empleado();
                    $resultado = $responsable->buscarDatos($nro_empleado);
                    if ($resultado){
                        echo("Ingrese el nuevo nro de licencia: ");
                        $nro_licencia = trim(fgets(STDIN));
                        echo("Ingrese el nuevo nombre: ");
                        $nombre = trim(fgets(STDIN));
                        echo("Ingrese el nuevo apellido: ");
                        $apellido = trim(fgets(STDIN));
                        $responsable->cargarDatos($nro_empleado, $nro_licencia, $nombre, $apellido);

                        if($responsable->modificar()) {
                            echo("Responsable modificado exitosamente\n");
                        } else {
                            echo("ERROR: Datos erroneos");
                        }
                    } else {
                        echo("Responsable no encontrado \n");
                    }
                    break;               
                case 4:
                    $flag= false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
            echo("\n");
        }
        echo("\n");
    }

    function pedir_id_viaje(){
        echo("Ingrese el id del viaje: ");
        $nro = trim(fgets(STDIN));
        return $nro;
    }

    function abm_viaje(){
        $azul = "\033[31m";
        $reset = "\033[0m";
        $flag = true;

        while ($flag){
            echo($azul."ABM Viajes  \n".$reset);
            opciones_abm();
            $opcion = trim(fgets(STDIN));
            $viaje = new Viaje();

            switch ($opcion) {
                case 1:
                    echo($azul."Ingresar Viaje: \n".$reset);
                    echo("Ingresar un ID de las siguientes empresa del viaje: \n");
                    verEmpresas();
                    $id_empresa = trim(fgets(STDIN));
                    $empresa = new Empresa();
                    if ($empresa->buscarDatos($id_empresa)){
                        echo("Ingresar uno de los nro de empleados de los siguientes responsables: \n");
                        verResponsables();
                        $nro_empleado = trim(fgets(STDIN));
                        $responsable = new ResponsableV();
                        if($responsable->buscarDatos($nro_empleado)){
                            echo("Ingresar Destino: ");
                            $destino = trim(fgets(STDIN));
                            echo("Ingresar cantidad max de pasajeros: ");
                            $max_pasajeros = trim(fgets(STDIN));
                            echo("Ingresar valor del importe: ");
                            $valor_importe = trim(fgets(STDIN));
                            $viaje->cargarDatos(null, $empresa, $responsable, $destino, $max_pasajeros, $valor_importe);
                            if ($viaje->insertar()) {
                                echo "Viaje ingresado exitosamente\n";
                            } else {
                                echo("ERROR: Datos erroneos");
                            }
                        } else {
                            echo("ERROR: Responsable inexistente");
                        }
                    } else {
                        echo("ERROR: Empresa inexistente");
                    }
                    
                    break;
                case 2:
                    echo($azul."Eliminar un Viaje (se eliminaran los pasajeros relacionado a este viaje): \n".$reset);
                    verViajes();
                    $id_viaje = pedir_id_viaje();
                    $resultado = $viaje->buscarDatos($id_viaje);
                    if ($resultado){
                        foreach ($viaje->getPasajeros() as $pasajero) {
                            $pasajero->eliminar();
                        }
                        $viaje->eliminar();
                        echo("Viaje eliminado exitosamente \n");
                    } else {
                        echo("Viaje no encontrado \n");
                    }
                    break;
                case 3:
                    echo($azul."Modificar Viaje: \n".$reset);
                    $id_viaje = pedir_id_viaje();
                    $resultado = $viaje->buscarDatos($id_viaje);
                    if ($resultado){
                        echo("Ingresar un nuevo ID de las siguientes empresa del viaje: \n");
                        verEmpresas();
                        $id_empresa = trim(fgets(STDIN));
                        $empresa = new Empresa();
                        if ($empresa->buscarDatos($id_empresa)){
                            echo("Ingresar uno de los nro de empleados de los siguientes responsables: \n");
                            verResponsables();
                            $nro_empleado = trim(fgets(STDIN));
                            $responsable = new ResponsableV();
                            if($responsable->buscarDatos($nro_empleado)){
                                echo("Ingresar el nuevo Destino: ");
                                $destino = trim(fgets(STDIN));
                                echo("Ingresar la nueva cantidad max de pasajeros: ");
                                $max_pasajeros = trim(fgets(STDIN));
                                echo("Ingresar el nuevo valor del importe: ");
                                $valor_importe = trim(fgets(STDIN));
                                $viaje->cargarDatos($id_viaje, $empresa, $responsable, $destino, $max_pasajeros, $valor_importe);

                                if($viaje->modificar()) {
                                    echo("Viaje modificado exitosamente\n");
                                } else {
                                    echo("ERROR: Datos erroneos");
                                }
                            } else {
                                echo("ERROR: Responsable inexistente");
                            }
                        } else {
                            echo("ERROR: Empresa inexistente");
                        }
                    } else {
                        echo("Viaje no encontrado \n");
                    }
                    break;               
                case 4:
                    $flag= false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
            echo("\n");
        }
        echo("\n");
    }

    function pedir_id_empresa(){
        echo("Ingrese el id de la empresa: ");
        $id_empresa = trim(fgets(STDIN));
        return $id_empresa;
    }

    function abm_empresa(){
        $azul = "\033[31m";
        $reset = "\033[0m";
        $flag = true;

        while ($flag){
            echo($azul."ABM Empresas  \n".$reset);
            opciones_abm();
            $opcion = trim(fgets(STDIN));
            $empresa = new Empresa();

            switch ($opcion) {
                case 1:
                    echo($azul."Ingresar empresa \n".$reset);
                    echo("Ingresar el nombre de la empresa: ");
                    $nombre = trim(fgets(STDIN));
                    echo("Ingresar la direccion: ");
                    $direccion = trim(fgets(STDIN));

                    $empresa->cargarDatos(null, $nombre, $direccion);
                    if ($empresa->insertar()) {
                        echo "Empresa ingresada exitosamente\n";
                    } else {
                        echo("ERROR: Datos erroneos");
                    }
                    
                    break;
                case 2:
                    echo($azul."Eliminar 1 Empresa de las siguientes\n".$reset);
                    verEmpresas();
                    $id_empresa = pedir_id_empresa();
                    $resultado = $empresa->buscarDatos($id_empresa);
                    if ($resultado){
                        $viajes = $empresa->getViajes();
                        if (count($viajes) > 0){
                            echo("ERROR: Debe eliminar primero los siguientes viajes relacionadas a la empresa: \n");
                            foreach ($viajes as $v) {
                               echo("- ".$v->getIdviaje()."\n");
                            }
                        } else {
                            $empresa->eliminar();
                            echo("Empresa eliminada exitosamente \n");
                        }
                    } else {
                        echo("Empresa no encontrada \n");
                    }
                    break;
                case 3:
                    echo($azul."Modificar Empresa \n".$reset);
                    $id_empresa = pedir_id_empresa();
                    $resultado = $empresa->buscarDatos($id_empresa);

                    if ($resultado){
                        echo("Ingresar el nuevo nombre: ");
                        $nombre = trim(fgets(STDIN));
                        echo("Ingresar la nueva direccion: ");
                        $direccion = trim(fgets(STDIN));
                        $empresa->cargarDatos($id_empresa, $nombre, $direccion);
                        if($empresa->modificar()) {
                            echo("Empresa modificada exitosamente\n");
                        } else {
                            echo("ERROR: Datos erroneos");
                        }
                    } else {
                        echo("Empresa no encontrada \n");
                    }
                    break;               
                case 4:
                    $flag= false;
                    break;
                default:
                    echo("--- Opcion invalida ---\n");
                    break;
            }
            echo("\n");
        }
        echo("\n");
    }
    
    
    
   
    function verViajes() {
        $verde = "\033[32m";
        $reset = "\033[0m";
        $viaje =  new Viaje();
        $colViajes = $viaje->listar();
        if (count($colViajes) > 0) {
            echo $verde."Viajes\n";
            echo "--------------------------------------------------\n";
            foreach ($colViajes as $cadaViaje){
                echo $cadaViaje;
                echo "--------------------------------------------------\n";
            }
        } else {
            echo "-------------- No existen viajes ---------------\n";
        }
        echo ($reset);
    }


   
    function verResponsables() {
        $verde = "\033[32m";
        $reset = "\033[0m";
        $responsable =  new ResponsableV();
        $colResponsables = $responsable->listar();
        if (count($colResponsables) > 0) {
            echo $verde."Responsables:\n";
            echo "--------------------------------------------------\n";
            foreach ($colResponsables as $cadaResponsable){
                echo $cadaResponsable;
                echo "--------------------------------------------------\n";
            }
        } else {
            echo "-------------- No existen responsables ---------------\n";
        }
        echo ($reset);
    }


   
    function verPasajeros() {
        $verde = "\033[32m";
        $reset = "\033[0m";
        $pasajero =  new Pasajero();
        $colPasajeros = $pasajero->listar();
        if (count($colPasajeros) > 0) {
            echo $verde."Pasajeros:\n";
            echo "---------------------------------------------------\n";
            foreach ($colPasajeros as $cadaPasajero){
                echo $cadaPasajero;
                echo "---------------------------------------------------\n";
            }
        } else {
            echo "-------------- No existen pasajeros ---------------\n";
        }
        echo ($reset);
    }

   
    function verEmpresas() {
        $verde = "\033[32m";
        $reset = "\033[0m";
        $empresa =  new Empresa();
        $colEmpresas = $empresa->listar();
        if (count($colEmpresas) > 0) {
            echo $verde."Empresas:\n";
            echo "--------------------------------------------------\n";
            foreach ($colEmpresas as $cadaEmpresa){
                echo $cadaEmpresa;
                echo "--------------------------------------------------\n";
            }
        } else {
            echo "-------------- No existen empresas ---------------\n";
        }
        echo ($reset);
    }
?>