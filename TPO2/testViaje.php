<?php 
include 'Viaje.php';
include 'Pasajero.php';
include 'ResponsableV.php';


function precarga_pasajeros(){
    $pasajeros[0] = new Pasajero(10000000, 'Guillermo', 'Diaz', '0299-412-1231');
    $pasajeros[1] = new Pasajero(11111111, 'Jamiro', 'Zuñiga', '0299-634-1413');
    $pasajeros[2] = new Pasajero(22222222, 'Franco', 'Benitez', '0299-765-6346');
    $pasajeros[3] = new Pasajero(33333333, 'Agustin', 'Heredia', '0299-756-6543');
    $pasajeros[4] = new Pasajero(44444444, 'Cristopher', 'Ovaillos', '0299-091-2321');
    $pasajeros[5] = new Pasajero(55555555, 'Sebastian', 'Iovaldi', '0299-645-4324');
    $pasajeros[6] = new Pasajero(66666666, 'Catalina', 'Rodriguez', '0299-981-2734');
    $pasajeros[7] = new Pasajero(77777777, 'Rodrigo', 'Piersigili', '0299-756-9752');
    $pasajeros[8] = new Pasajero(88888888, 'Sofia', 'Hernandez', '0299-382-9137');
    $pasajeros[9] = new Pasajero(99999999, 'Facundo', 'Escudero', '0299-903-1841');
    return $pasajeros;
}

//verifica si la clave de pasajero se repite en el array
function esta_repetido(&$pasajeros, $un_pasajero){
    $flag = false;
    $i = 0;
    $max = count($pasajeros);

    while (!$flag && $i < $max){
        if ($pasajeros[$i]->equals($un_pasajero)){
            $flag = true;
        } else {
            $i = $i + 1;
        } 
           
    }
    return $flag;
}


/**
* Carga pasajeros en un array con una cantidad fija y lo retorna
 * 
 * @param max cantidad maxima pasajeros
 */
function cargar_pasajeros($max){
    $pasajeros = [];
    $cant = 0;
    $flag = true;

    while ($flag && $cant < $max) {
        $pas = (crear_pasajero($pasajeros));
        echo "\n";
        if (!esta_repetido($pasajeros, $pas)) {
            $pasajeros[$cant] =  $pas;
            $cant++;

            if ($cant < $max) {
                echo "Ingrese 0 si desea agregar otro pasajero: ";
                $option = trim(fgets(STDIN));
                echo "\n";
                if ($option != 0) {
                    $flag = false;
                }
            } else {
                $flag = false;
            }
        } else{
            echo "ERROR: Esta repetido el dni \n";
        }
        
    }
    return $pasajeros;
} 

//verifica si es dni
function es_dni($dni){
    return $dni >= 0 && is_numeric($dni);
}

/**
 * Crea una instancia pasajero 
 * 
 * @param array de pasajeros
 * @return pasajero
 */
function crear_pasajero(){
    do{
        echo "Ingrese el nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido: \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el DNI: \n";
        $dni = trim(fgets(STDIN));
        echo "Ingrese el teléfono: \n";
        $telefono = trim(fgets(STDIN));

        $flag = es_dni($dni) && !empty($nombre) && !empty($apellido);
        if (!$flag){
            echo "ERROR: Ingrese datos coherentes\n";
        } 
    } while (!$flag);
    return new Pasajero($dni, $nombre, $apellido, $telefono);
}

function crear_responsable(){
    do{
        echo "Ingrese el nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido: \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el nro licencia: \n";
        $nro_licencia = trim(fgets(STDIN));
        echo "Ingrese el nro empleado: \n";
        $nro_empleado = trim(fgets(STDIN));

        $flag = !empty($nro_licencia) && !empty($nro_empleado) && !empty($nombre) && !empty($apellido);
        if (!$flag){
            echo "ERROR: Ingrese datos coherentes\n";
        } 
    } while (!$flag);
    return new ResponsableV($nombre, $apellido, $nro_empleado, $nro_licencia);
}

function menu_pasajeros(&$viaje){
    
    do {
        echo <<<END
    
        ---------------------------- Opciones Pasajeros ----------------------------
            1) Agregar pasajero
            2) Cambiar nombre de un pasajero
            3) Cambiar apellido de un pasajero
            4) Reemplazar pasajeros actuales (Con el limite del viaje)
            5) Reemplazar pasajeros actuales con otra cantidad máxima
            6) Volver
        ----------------------------------------------------------------------------
        - Ingrese una opcion: 
        END;
        $opcion = trim(fgets(STDIN));
        switch($opcion){
            case 1: 
                echo "AGREGAR PASAJERO: RECUERDE QUE NO SE ADMITEN DNI REPETIDOS DENTRO DEL VIAJE \n";
                $pasajeros = $viaje->getPasajeros();
                $pas = crear_pasajero($pasajeros);
                if($viaje->agregar_pasajero($pas)){
                    echo "Pasajero agregado ";
                } else{
                    echo "ERROR: No se pudo agregar al pasajero, excede el limite max de pasajeros o está repetido en el viaje";
                }
                
                break;
            case 2: 
                echo "Ingrese el nuevo nombre: ";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese el DNI del pasajero al cual le va a cambiar el nombre: ";
                $dni = trim(fgets(STDIN));
                if (es_dni($dni)){
                    
                    if ($viaje->set_nombre_pasajero($dni, $nombre)){
                        echo "Nombre modificado ";
                    } else {
                        echo "ERROR: pasajero no existe en el viaje";
                    }
                } else{
                    echo "ERROR: dni incoherente";
                }
                
                break;
            case 3: 
                echo "Ingrese el nuevo apellido: ";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese el DNI del pasajero al cual le va a cambiar el apellido: ";
                $dni = trim(fgets(STDIN));
                if (es_dni($dni)){
                    
                    if ($viaje->set_apellido_pasajero($dni, $apellido)){
                        echo "Apellido modificado ";
                    } else {
                        echo "ERROR: pasajero no existe en el viaje";
                    }
                } else{
                    echo "ERROR: dni incoherente";
                }
                

                break;
            case 4: 
                $max = $viaje->getMax_pasajeros();
                echo "Cargue los pasajeros que desee, recuerde que el limite es: ".$max."\n";
                $pasajeros = cargar_pasajeros($max);
                if ($viaje->setPasajeros($pasajeros)){
                    echo "Se cargaron exitosamente";
                } else {
                    echo "ERROR: No se pudo cambiar los pasajeros";
                }
                
                break;
            case 5: 
                $max = solicitar_cant_max_pasajeros();
                echo "Cargue los pasajeros que desee, recuerde que el limite es: ".$max."\n";
                $pasajeros = cargar_pasajeros($max);

                if ($viaje->setPasajerosConLimite($pasajeros, $max)){
                    echo "Se cargaron exitosamente";
                } else {
                    echo "ERROR: No se pudo cambiar los pasajeros";
                }
                
                break; 
            case 6: 
                    
            break;
        }
        
        echo "\n";
        
    } while ($opcion != 6);
}

function menu_opciones(){
    $pasajeros = precarga_pasajeros();
    $viaje = new Viaje(123, "Perú", 13, $pasajeros, new ResponsableV('Leonel', 'Llancaqueo', 'FAI-1231', 541));

    do {
        $opcion = menu();
        echo "\n";

        switch($opcion){
            case 1: 
                echo "Información del viaje: \n";
                echo $viaje->__toString();
                break;
            case 2: 
                echo "Información de todos los pasajeros: \n";
                print_r($viaje->getPasajeros());
                break;
            case 3: 
                $cant = solicitar_cant_max_pasajeros();

                if ($viaje->setMax_pasajeros($cant)){
                    echo "Cantidad actualizada";
                } else{
                    echo "La cantidad ingresada excede el numero de personas actual";
                }

                break;
            case 4: 
                echo "Ingrese el nuevo destino: ";
                $destino = trim(fgets(STDIN));
                if (empty($destino)){
                    echo "ingrese un destino coherente";
                } else {
                    $viaje->setDestino($destino);
                    echo "Destino cambiado";
                }
                break;
            case 5: 
                menu_pasajeros($viaje);
                break; 
            case 6: 
                $responsable = crear_responsable();
                $viaje->setResponsable($responsable);
                echo "Responsable modificado";
                break;  
            case 7: 
                echo "Saliendo...";
                break;
            }       
        echo "\n";        
    } while ($opcion != 7);
}


function solicitar_cant_max_pasajeros(){
    do {
        echo "Ingrese la cantidad máxima de pasajeros: \n";
        $cant = trim(fgets(STDIN));
        $flag = $cant > 0 && is_numeric($cant); //si es un numero y es coherente
        if (!$flag){
            echo "ERROR: Ingrese una cant coherente\n";
        }
    } while (!$flag);
    return $cant;
}

function menu(){
    do {
        echo <<<END
    
        ----------------------------------- Menu -----------------------------------
            1) Ver datos del viaje (Sin los datos de los pasajeros)
            2) Ver Pasajeros
            3) Modificar cantidad máxima de pasajeros
            4) Modificar destino del viaje
            5) Modificar pasajeros 
            6) Modificar responsable
            7) Salir
        ----------------------------------------------------------------------------
        - Ingrese una opcion: 
        END;
        $opcion = trim(fgets(STDIN));

        $salir = $opcion > 0 && $opcion <7;
        if (!$salir){
            echo "ERROR: Ingrese una opcion válida";
        }
    } while (!$salir);
    return $opcion;
}

menu_opciones();



?>