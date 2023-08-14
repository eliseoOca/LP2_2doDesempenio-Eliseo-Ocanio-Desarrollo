<?php 
function DatosLogin($vUsuario, $vClave, $vConexion){

    $Usuario=array();

    $vClave = MD5($vClave);

    $SQL="SELECT u.id, u.Nombre, u.Apellido, r.rango as Rango, u.foto, r.id as Id_Rango, u.Email
     FROM usuarios u, rango r
     WHERE u.id_rango = r.id 
     AND u.Email='$vUsuario' AND u.Clave='$vClave'";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $Usuario['ID'] = $data['id'];
        $Usuario['NOMBRE'] = $data['Nombre'];
        $Usuario['APELLIDO'] = $data['Apellido'];
        $Usuario['RANGO'] = $data['Rango'];  
        $Usuario['ID_RANGO'] = $data['Id_Rango'];  
        $Usuario['EMAIL'] = $data['Email'];              

        if (empty($data['foto'])) {
            $data['Imagen'] = 'user.jpg'; 
        }
        $Usuario['IMG'] = $data['foto'];
        
    }
    return $Usuario;
}

?>