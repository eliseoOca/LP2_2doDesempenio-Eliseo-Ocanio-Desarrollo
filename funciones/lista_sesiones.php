<?php 

function Lista_sesiones($vConexion){
    $ListadoS=array();

    $SQL = "SELECT id_s, sesiones FROM prestaciones  ORDER BY  id_s ASC ";

    $rs = mysqli_query($vConexion, $SQL);

    $i=0;
    while($data = mysqli_fetch_array($rs)){
        $ListadoS[$i]['ID'] = $data['id_s'];
        $ListadoS[$i]['SESIONES'] = $data['sesiones'];
        
        $i++;

    }
    return $ListadoS;
}

?>