<?php 

function insertar_turno($vConexion, $idPaciente, $idPrestacion, $fecha, $idUsuario){
    $id_medico=0;
    $id_obra_social = 0;

    $SQL = "SELECT um.id_medico 
    FROM usuario_medico um 
    WHERE um.id_usuario = '$idUsuario'";

    $rs = mysqli_query($vConexion, $SQL);
    $data = mysqli_fetch_array($rs);

    if(!empty($data)){
        $id_medico = $data['id_medico'];
    }
    
    $SQL = "SELECT id_obra_social
    FROM paciente
    WHERE id_p = '$idPaciente'";

    $rs = mysqli_query($vConexion, $SQL);
    $data = mysqli_fetch_array($rs);

    if(!empty($data)){
        $id_obra_social= $data['id_obra_social'];
    }

    $SQL = "INSERT INTO turnero(fecha,id_paciente,id_obra_social,id_medico,id_prestacion,id_estado_turno,id_usuario) 
    VALUES ('{$fecha}','{$idPaciente}','{$id_obra_social}','{$id_medico}','{$idPrestacion}',3,'{$idUsuario}')";
    // retorna true cuando hay errores
    if(!mysqli_query($vConexion, $SQL)){
        return true;
    }
    //retorna false cuando no hay errores
    return false;

}

?>