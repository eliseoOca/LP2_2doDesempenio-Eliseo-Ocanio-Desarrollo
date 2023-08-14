<?php
function validarPermisoUsuario($idNivel)
{
    $aprobado = 0;
    if($idNivel == 1){
        $aprobado = 0;
    }
    if($idNivel == 2){
        $aprobado = 1;
    }
    if($idNivel == 3){
        $aprobado = 0;
    }
    if($idNivel == 4){
        $aprobado = 1;
    }
    return $aprobado;
}

function validarMensajeTituloPorNivel($idNivel){

    $mensaje = 'Todas las prestaciones cargadas';
    if($idNivel == 3){
        $mensaje = 'Mis turnos asignados';
    }
    if($idNivel == 2){
        $mensaje = 'Mis Prestaciones cargadas';
    }
    return $mensaje;

}

function sumarPrestacionesComplejas($listaCantidadTurnos){

    $cantidadPrestasiones = 0;
    for($i = 0; $i < count($listaCantidadTurnos); $i++){
        if(!empty($listaCantidadTurnos[$i]['PRECIO'])){
            $cantidadPrestasiones++;
        }
    }
    return $cantidadPrestasiones;

}

function sumarPrecioPrestacionesComplejas($listaCantidadTurnos){

    $montoTotal = 0;
    for($i = 0; $i < count($listaCantidadTurnos); $i++){
        //tomagrafia se paga un 10% del valor de esa terapia
        //Resonancia Magnética se paga un 20% del valor de esa terapia
        if(!empty($listaCantidadTurnos[$i]['PRECIO'])){
            $montoTotal += ($listaCantidadTurnos[$i]['PRECIO'] * $listaCantidadTurnos[$i]['PORCENJATE_PRESTACION'])/100;
        }
    }
    return $montoTotal;

}
function validarBotonesAccionesPorNivel($idNivel){
    $aprobado = 0;
    if($idNivel == 1){
        $aprobado = 0;
    }
    if($idNivel == 2){
        $aprobado = 0;
    }
    if($idNivel == 3){
        $aprobado = 0;
    }
    if($idNivel == 4){
        $aprobado = 1;
    }
    return $aprobado;

}

function getDatosTurneroPorNivel($idNivel){
    $getListaTurnero = 0;
    if($idNivel == 1){
        $getListaTurnero = 0;
    }
    if($idNivel == 2){
        $getListaTurnero = 1;
    }
    if($idNivel == 3){
        $getListaTurnero = 1;
    }
    if($idNivel == 4){
        $getListaTurnero = 0;
    }
    return $getListaTurnero;

}

function validarCargaPrestacion($nombrePerstacion, $esCompleja, $precio, $porcentaje){
    $mensaje = '';
    if (strlen($nombrePerstacion) < 5){
          return  $mensaje = '<div class="alert alert-warning" role="alert">  <i data-feather="alert-circle"></i> El nombre de la prestacion debe contener mas de 4 letras</div>';    
    }
    if($esCompleja){
        if(empty($precio) || empty($porcentaje)){
           return $mensaje = '<div class="alert alert-warning" role="alert">  <i data-feather="alert-circle"></i> La prestacion que desea cargar es compleja, debe cargar el precio y el porcentaje</div>';    

        }
    }

    return $mensaje;
}

function validarAccesoCargaPrestacion($rango){
    if($rango == 4){
        return true;
    }
    return false;
}
?>