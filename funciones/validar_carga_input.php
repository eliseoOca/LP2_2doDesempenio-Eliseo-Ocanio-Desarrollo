<?php 
function validar_input(){
    $mensaje='';
    $fechaActual = date("Y-m-d");

    if (empty($_POST['pacientes']) || empty($_POST['sesiones']) || empty($_POST['fecha'])  ){
        return $mensaje.='<div class="alert alert-warning" role="alert">  <i data-feather="alert-circle"></i> Debe completar todos los datos requeridos.</div>';        
    }
    if (($_POST['fecha']) < $fechaActual  ){
        return $mensaje.='<div class="alert alert-warning" role="alert"> <i data-feather="alert-circle"></i> Ingrese una fecha correcta. </div>';        
    }    
}


?>