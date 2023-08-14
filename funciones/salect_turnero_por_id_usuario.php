<?php

function Listar_turnero_por_id_usuario($vConexion, $idUsuario)
{

    $lista_turnero = array();
    $SQL = "";
    //si la variable $obtenerLista es igual a 0 es por que la peticion la hizo un usuario
    if (!empty($idUsuario)) {

        $SQL = "SELECT t.id, t.fecha
            , CONCAT(pa.Nombre_p, ' ' , pa.Apellido_p) as 'nombre_completo'
            , CONCAT(m.nombre, ' ' , m.apellido) as 'nombre_medico'
            , ob.obra_social
            , pre.sesiones
            , pre.precio
            , et.id as 'estado_turno'
            , pre.porcentaje
        FROM turnero t, paciente pa, medicos m, obra_social ob, prestaciones pre, estado_turno et
        WHERE t.id_paciente = pa.id_p
        AND t.id_medico = m.id
        AND t.id_obra_social = ob.id
        AND t.id_prestacion = pre.id_s
        AND t.id_estado_turno = et.id
        AND t.id_usuario = '$idUsuario'
        order by fecha ";

    } 


    $rs = mysqli_query($vConexion, $SQL);

    $i = 0;
    while ($data = mysqli_fetch_array($rs)) {
        $lista_turnero[$i]['ID'] = $data['id'];
        $lista_turnero[$i]['FECHA'] = $data['fecha'];
        $lista_turnero[$i]['NOMBRE_PACIENTE'] = $data['nombre_completo'];
        $lista_turnero[$i]['OBRA_SOCIAL'] = $data['obra_social'];
        $lista_turnero[$i]['ESPECIALISTA'] = $data['nombre_medico'];
        $lista_turnero[$i]['SESIONES'] = $data['sesiones'];
        $lista_turnero[$i]['PRECIO'] = $data['precio'];
        $lista_turnero[$i]['ESTADO_TURNO'] = $data['estado_turno'];
        $lista_turnero[$i]['PORCENJATE_PRESTACION'] = $data['porcentaje'];

        $i++;
    }
    return $lista_turnero;

}

function Listar_turnero_por_id_medico($vConexion, $idUsuario)
{

    $lista_turnero = array();
    $id_medico=0;

    $SQL = "SELECT um.id_medico 
    FROM usuarios u, usuario_medico um 
    WHERE u.id = um.id_usuario
    AND u.id = '$idUsuario'";

    $rs = mysqli_query($vConexion, $SQL);
    $data = mysqli_fetch_array($rs);

    if(!empty($data)){
        $id_medico = $data['id_medico'];
    }

    if (!empty($id_medico)) {

        $SQL = "SELECT t.id, t.fecha
            , CONCAT(pa.Nombre_p, ' ' , pa.Apellido_p) as 'nombre_completo'
            , CONCAT(m.nombre, ' ' , m.apellido) as 'nombre_medico'
            , ob.obra_social
            , pre.sesiones
            , pre.precio
            , et.id as 'estado_turno'
            , pre.porcentaje
        FROM turnero t, paciente pa, medicos m, obra_social ob, prestaciones pre, estado_turno et
        WHERE t.id_paciente = pa.id_p
        AND t.id_medico = m.id
        AND t.id_obra_social = ob.id
        AND t.id_prestacion = pre.id_s
        AND t.id_estado_turno = et.id
        AND t.id_medico = '$id_medico'
        order by fecha ";

    } 

    $rs = mysqli_query($vConexion, $SQL);

    $i = 0;
    while ($data = mysqli_fetch_array($rs)) {
        $lista_turnero[$i]['ID'] = $data['id'];
        $lista_turnero[$i]['FECHA'] = $data['fecha'];
        $lista_turnero[$i]['NOMBRE_PACIENTE'] = $data['nombre_completo'];
        $lista_turnero[$i]['OBRA_SOCIAL'] = $data['obra_social'];
        $lista_turnero[$i]['ESPECIALISTA'] = $data['nombre_medico'];
        $lista_turnero[$i]['SESIONES'] = $data['sesiones'];
        $lista_turnero[$i]['PRECIO'] = $data['precio'];
        $lista_turnero[$i]['ESTADO_TURNO'] = $data['estado_turno'];
        $lista_turnero[$i]['PORCENJATE_PRESTACION'] = $data['porcentaje'];

        $i++;
    }
    return $lista_turnero;

}



?>