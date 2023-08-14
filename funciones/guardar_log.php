<?php
    function guardar_log ($nombrePrestacion, $email ){
        $logFile = fopen("DATA/prestaciones.log", 'a') or die("Error creando archivo");
        fwrite($logFile,date("Ymd ")."|".$nombrePrestacion."|".$email."\n") or die("Error escribiendo en el archivo");
        fclose($logFile);
    }
?>