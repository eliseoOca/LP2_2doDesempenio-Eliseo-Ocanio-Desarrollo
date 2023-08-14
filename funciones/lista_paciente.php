<?php 

function Lista_paciente($vConexion){
    $Listado=array();

    $SQL = "SELECT p.Id_p, p.Nombre_p, p.Apellido_p, p.DNI_p, p.id_obra_social FROM paciente p ORDER BY  Apellido_p ASC ";

    $rs = mysqli_query($vConexion, $SQL);

    $i=0;
    while($data = mysqli_fetch_array($rs)){
        $Listado[$i]['ID'] = $data['Id_p'];
        $Listado[$i]['APELLIDO'] = $data['Apellido_p'];
        $Listado[$i]['NOMBRE'] = $data['Nombre_p'];       
        $Listado[$i]['DNI'] = $data['DNI_p'];            
        $Listado[$i]['ID_OBRA_SOCIAL'] = $data['id_obra_social'];
        $i++;

    }
    return $Listado;

}

?>