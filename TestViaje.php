<?php
/**
 * TestViaje.php
 * JORGE SEGURA
 * FAI 231
 * Introduction a la Programacion Orientada a Ojetos
 */

include 'Viaje.php';

/**
 * @param array $misViajes
 * @param string $unCodigo
 * @return boolean
 */
function existeViaje($misViajes, $unCodigo){
    /*Recorro la lista de viajes para verificar si existe el codigo */
    $i = 0;
    $cant = count($misViajes);
    $existe = false;
    while ($i < $cant && !$existe) {
        $objViaje = $misViajes[$i];
        if ($objViaje->existeViaje($unCodigo)) {
            $existe = true;
        }
        $i++;
    }
    return $existe;
}

/**
 * @param array $misViajes
 * @param string $unCodigo
 * @return Viaje
 * 
 */
function recuperarViaje($misViajes, $unCodigo){
    $i = 0;
    $cant = count($misViajes);
    $encontrado = false;
    while ($i < $cant && !$encontrado) {
        $objViaje = $misViajes[$i];
        if ($objViaje->getCodigo() == $unCodigo) {
            $encontrado = true;
        }
        $i++;
    }
    return $objViaje;
}

/**
 * @param array $misViajes
 * @return array
 */
function crearViaje($misViajes){
    $cant = count($misViajes);

    echo "CREAR NUEVO VIAJE \n";
    echo "***************** \n";
    echo "Ingrese un codigo: ";
    $codigo = trim(fgets(STDIN));

    if (existeViaje($misViajes, $codigo)) {
        echo "El codigo de viaje ya existe... NO SE PUEDE CREAR OTRA VEZ \n";
    } else {
        echo "Ingrese destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingrese cantidad de pasajeros maxima: ";
        $cantidad = trim(fgets(STDIN));

        $nuevoObjViaje = new Viaje($codigo, $destino, $cantidad);
        $misViajes[$cant] = $nuevoObjViaje;
        echo "El viaje se creo existosamente\n";
    }
    return $misViajes;
}

/**
 * @param array $misViajes
 */
function mostrarViajes($misViajes){
    $cant = count($misViajes);
   
    foreach ($misViajes as $elemento) {
        echo $elemento;
    }
}

function mostrarDatosViaje($misViajes){
    $cant = count($misViajes);

    echo "DATOS DEL VIAJE \n";
    echo "***************** \n";
    echo "Ingrese un codigo: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);
        echo $objViaje;
    } else {
        echo "NO EXISTE EL VIAJE CON CODIGO: " . $codigo . "\n";
    }
}

/**
 * @param array $misViajes
 */
function cargarPasajero($misViajes){
    $cant = count($misViajes);

    echo "INGRESO DE PASAJERO NUEVO \n";
    echo "************************* \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);

        if ($objViaje->disponibilidad()>0){
        echo "Ingrese DNI: ";
        $dni = trim(fgets(STDIN));
        if ($objViaje->existeDni($dni)) {
            echo "EL PASAJERO YA EXISTE EN ESTE VIAJE \n";
        } else {
            echo "Ingrese Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese Apellido: ";
            $apellido = trim(fgets(STDIN));

            $objViaje->agregarPasajero($nombre, $apellido, $dni);
        }
        }else{
            echo "NO QUENDAN VANCANTES EN EL VIAJE : " . $codigo . " Destino: ".$objViaje->getDestino()."\n";
        }   
    } else {
        echo "NO EXISTE EL CODIGO de VIAJE: " . $codigo . "\n";
    }
}

/**
 * @param array $misViajes
 */
function mostrarPasajeros($misViajes){
    $cant = count($misViajes);

    echo "PASAJEROS DE UN VIAJE \n";
    echo "********************* \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);
        echo $objViaje->mostrarPasajeros();
    } else {
        echo "NO EXISTE EL CODIGO de VIAJE: " . $codigo . "\n";
    }
}

/**
 * @param array $misViajes
 */
function mostrarDisponibilidad($misViajes){
    $cant = count($misViajes);

    echo "LUGARES DISPONIBLES DE UN VIAJE \n";
    echo "******************************* \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);

        echo "Lugares disponibles: " . $objViaje->disponibilidad() . "\n";
    } else {
        echo "NO EXISTE EL CODIGO de VIAJE: " . $codigo . "\n";
    }
}

/**
 * @param array $misViajes
 */
function modificarDatosViaje ($misViajes){
    $cant = count($misViajes);

    echo "MODIFICAR DATOS DE UN VIAJE \n";
    echo "*************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);
        echo $objViaje;
        echo "Ingrese destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingrese cantidad de pasajeros maxima: ";
        $cantidad = trim(fgets(STDIN));
        $objViaje->setDestino($destino);
        $objViaje->setCantMaxPasajeros($cantidad);
        echo "EL VIAJE SE MODIFICO CON EXITO \n";
        echo $objViaje;
    } else {
        echo "NO EXISTE EL CODIGO de VIAJE: " . $codigo . "\n";
    }
}

/**
 * @param array $misViajes
 */
function eliminarPasajeroPorDni($misViajes){
    $cant = count($misViajes);

    echo "ELIMINAR PASAJERO DE UN VIAJE (COD.VIAJE + DNI) \n";
    echo "*********************************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);
        echo $objViaje;
        echo "Ingrese el DNI del pasajero a ELIMINAR: ";
        $unDni=trim(fgets(STDIN));
        if ($objViaje->existeDni($unDni)){
            $objViaje->eliminarPasajero($unDni);
            echo"DATOS ACTUALIZADOS: \n";
            echo"******************* \n";
            echo $objViaje;
        }else{
            echo "El pasajero con DNI: ".$unDni." NO EXISTE \n";
        }
    }
}

/**
 * @param array $misViajes
 * @return array
 */
function eliminarViaje($misViajes){
    $cant = count($misViajes);

    echo "ELIMINAR VIAJE (COD.VIAJE) \n";
    echo "************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        
        foreach ($misViajes as $indice=>$objViaje){
            if ($objViaje->getCodigo()==$codigo){
                //encontre el viaje, entonces lo elimino.
                array_splice($misViajes,$indice,1);
                echo "El viaje ".$codigo." fue eliminado.\n";
            }
        }

    }
    return $misViajes;
}


/**
 * @param array $misViajes
 */
function modificarDatosPasajero($misViajes){
    $cant = count($misViajes);

    echo "MODIFICAR DATOS PASAJERO (COD.VIAJE + DNI) \n";
    echo "*********************************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($misViajes, $codigo)) {
        $objViaje = recuperarViaje($misViajes, $codigo);
        echo $objViaje;
        echo "Ingrese el DNI del pasajero: ";
        $unDni=trim(fgets(STDIN));
        if ($objViaje->existeDni($unDni)){
            echo "Ingrese nuevo Nombre: ";
            $nuevoNombre=trim(fgets(STDIN));
            echo "Ingrese nuevo Apellido: ";
            $nuevoApellido=trim(fgets(STDIN));
            echo "Ingrese nuevo DNI: ";
            $nuevoDni=trim(fgets(STDIN));
            
            $objViaje->modificarPasajero($unDni,$nuevoNombre,$nuevoApellido,$nuevoDni);

        }else{
            echo "El pasajero con DNI: ".$unDni." NO EXISTE \n";
        }
    }
}
/**
 * @return int
 */
function selectionarOpcion(){
    $opcionValida = true;
    $opcion = 0;
    do {
        echo "\n";
        echo "INGRESE UNA OPCION" . "\n";
        echo "1) Crear nuevo Viaje." . "\n";
        echo "2) Mostrar Viajes." . "\n";
        echo "3) Datos de un viaje." . "\n";
        echo "4) Cargar nuevo pasajero a un viaje." . "\n";
        echo "5) Mostrar pasajeros de un viaje." . "\n";
        echo "6) Mostrar lugares disponibles de un viaje" . "\n";
        echo "7) Modificar datos Viaje" . "\n";
        echo "8) Eliminar pasajero por DNI" . "\n";
        echo "9) Modificar datos pasajero por Viaje y DNI" . "\n";
        echo "10) Eliminar un viaje" . "\n";

        echo "0) Salir." . "\n";
        echo "\n";

        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "Opcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}





/* PROGRAMA PRINCIPAL */

/*Carga Inicial de datos */
$misViajes = [];
$misViajes[0]=new Viaje ("1","Brasil",3);
$misViajes[1]=new Viaje ("2","España",10);
$misViajes[2]=new Viaje ("100","Italia",1);
$misViajes[3]=new Viaje ("200","Peru",2);

$misViajes[3]->agregarPasajero("Juan","Perez","100");
$misViajes[3]->agregarPasajero("Jose","Fuentes","101");


do {
    $respuesta = selectionarOpcion();
    switch ($respuesta) {
        case 1:
            $misViajes=crearViaje($misViajes);
            break;
        case 2:
            mostrarViajes($misViajes);
            break;
        case 3:
            mostrarDatosViaje($misViajes);
            break;
        case 4:
            cargarPasajero($misViajes);
            break;
        case 5:
            mostrarPasajeros($misViajes);
            break;
        case 6:
            mostrarDisponibilidad($misViajes);
            break;
        case 7:
            modificarDatosViaje($misViajes);
            break;
        case 8:
            eliminarPasajeroPorDni($misViajes);
            break;
        case 9:
            modificarDatosPasajero($misViajes);
            break;
        case 10:
            $misViajes=eliminarViaje($misViajes);
            break;
    }
} while ($respuesta != 0);
