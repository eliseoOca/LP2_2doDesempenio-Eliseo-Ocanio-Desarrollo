<?php
//para el mysql instalado con Wamp, estos son los datos de conexion
//$Host = '127.0.0.1';


function ConexionBD(){
$Host = 'localhost';
$User = 'root';
$Password = '';
$BaseDeDatos='login'; 

//procedo al intento de conexion con esos parametros
    $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
    if ($linkConexion!=false) 
                
        return $linkConexion;
    else 
        die ('No se pudo establecer la conexion.');
}
?>



