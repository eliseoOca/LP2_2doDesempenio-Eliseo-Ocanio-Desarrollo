<?php 
require_once "funciones/guardar_log.php";
function insertar_prestacion($vConexion, $sesion, $precio, $porcentaje, $esCompleja, $activa,$email){
    

    $SQL = "INSERT INTO `prestaciones`(`sesiones`, `precio`, `porcentaje`, `es_compleja`, `activa`)
         VALUES ('{$sesion}','{$precio}','{$porcentaje}','{$esCompleja}','{$activa}')";
    // retorna true cuando hay errores
    if(!$activa){
        guardar_log($sesion,$email);
    }
    
    if(!mysqli_query($vConexion, $SQL)){        
        return  '<div class="alert alert-warning" role="alert">  <i data-feather="alert-circle"></i> Error al cargar la prestacion en la base de datos</div>';    
    }
    //retorna false cuando no hay errores
   
    return '<div class="alert alert-success" role="alert">  <i data-feather="check-circle"></i> Se han registrado los datos ingresados. </div>';;
}

?>