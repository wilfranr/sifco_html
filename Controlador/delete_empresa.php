<?php
    include '../includes/script.php';
   
    Delete_user($_GET['usr']);
    function Delete_user($id){
        include '../includes/conexion.php';
        $setenece = "DELETE FROM configuracion WHERE id = '".$id."' ";
        $conexion->query($setenece) or die ("Error al buscar en la base de datos: ".mysqli_error($conexion));
        mysqli_close($conexion);
    }
    echo '<script> window.location.href= "../Vista/html/configuracion.php";</script>';
    
    
?>