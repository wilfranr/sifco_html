<?php
    
    Delete_user($_GET['usr']);
    function Delete_user($codproveedor){
        include '../includes/conexion.php';
        $setenece = "DELETE FROM proveedor WHERE codproveedor = '".$codproveedor."' ";
        $conexion->query($setenece) or die ("Error al buscar en la base de datos: ".mysqli_error($conexion));
        mysqli_close($conexion);
    }
    echo '<script>';
            echo 'alert("Proveedor Eliminado");';
            echo 'window.location.href= "../Vista/html/proveedores.php"';
    echo '</script>';


    
?>