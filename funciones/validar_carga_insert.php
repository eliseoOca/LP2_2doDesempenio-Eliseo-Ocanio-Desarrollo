<?php 
function validar_insert(){
    $vMensaje='';
    if (!empty($_POST['pacientes']) && !empty($_POST['sesiones']) && !empty($_POST['fecha'])){
        $vMensaje.='Se han registrado los datos ingresados. <br />';
        
    }
    return $vMensaje;
}


?>