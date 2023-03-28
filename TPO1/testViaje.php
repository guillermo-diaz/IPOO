<?php 
include 'Viaje.php';


function precarga_pasajeros(){
    $pasajeros[0] = ["DNI" => 00000000, "nombre" => 'Guillermo', "apellido" => 'Diaz'];
    $pasajeros[1] = ["DNI" => 11111111, "nombre" => 'Jamiro', "apellido" => 'Zuñiga'];
    $pasajeros[2] = ["DNI" => 22222222, "nombre" => 'Franco', "apellido" => 'Benitez'];
    $pasajeros[3] = ["DNI" => 33333333, "nombre" => 'Agustin', "apellido" => 'Heredia'];
    $pasajeros[4] = ["DNI" => 44444444, "nombre" => 'Cristopher', "apellido" => 'Ovaillos'];
    $pasajeros[5] = ["DNI" => 55555555, "nombre" => 'Sebastian', "apellido" => 'Iovaldi'];
    $pasajeros[6] = ["DNI" => 66666666, "nombre" => 'Catalina', "apellido" => 'Rodriguez'];
    $pasajeros[7] = ["DNI" => 77777777, "nombre" => 'Rodrigo', "apellido" => 'Piersigili'];
    $pasajeros[8] = ["DNI" => 88888888, "nombre" => 'Sofia', "apellido" => 'Hernandez'];
    $pasajeros[9] = ["DNI" => 99999999, "nombre" => 'Facundo', "apellido" => 'Escudero'];
    return $pasajeros;
}

function esta_repetido(&$pasajeros, $clave){
    $flag = false;
    $i = 0;
    $max = count($pasajeros);

    while (!$flag && $i < $max){
        if ($pasajeros[$i]['DNI'] == $clave){
            $flag = true;
        } else {
            $i = $i + 1;
        } 
           
    }
    return $flag;
}

function cargar_pasajeros($max){
    $pasajeros = [];
    $cant = 0;
    $flag = true; 

    while ($flag && $cant < $max ){
        $pas = (crear_pasajero($pasajeros));
        echo "\n";
        $pasajeros[$cant] =  $pas;
        $cant++;

        if ($cant < $max){
            echo "Ingrese 0 si desea agregar otro pasajero: ";
            $option = trim(fgets(STDIN));
            echo "\n";
            if ($option != 0){
                $flag = false;
            }
        } else {
            $flag = false;
        }
        
    }
    return $pasajeros;
} 

function es_dni($dni){
    return $dni >= 0 && is_numeric($dni);
}

function crear_pasajero(&$array_pasajeros){
    do{
        echo "Ingrese el nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido: \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el DNI: \n";
        $dni = trim(fgets(STDIN));

        $flag = es_dni($dni) && !empty($nombre) && !empty($apellido) && !esta_repetido($array_pasajeros, $dni);
        if (!$flag){
            echo "ERROR: Ingrese datos coherentes\n";
        } 
    } while (!$flag);
    return ["DNI" => $dni, "nombre" => $nombre, "apellido" => $apellido];
    
   
}

function menu_pasajeros(&$viaje){
    $salir = false;
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
                    echo "ERROR: No se pudo agregar al pasajero, excede el limite max de pasajeros ";
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
                    $salir = true;
                    break;
            default:
                echo "ERROR: Ingrese una opcion válida";
                break;

        }
        
        echo "\n";
        
    } while (!$salir);
}

function menu_opciones(){
    $pasajeros = precarga_pasajeros();
    $viaje = new Viaje(123, "Perú", 13, $pasajeros);

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
                echo "Saliendo...";
                break;
            }       
        echo "\n";        
    } while ($opcion != 6);
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
            6) Salir
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