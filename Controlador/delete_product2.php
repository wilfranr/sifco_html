<?php
    include '../includes/script.php';
   
    Delete_product($_GET['usr']);
    $codproducto = $_GET['usr'];

    function Delete_product($codproducto){
        include '../includes/conexion.php';
        //cambiar estado al eliminar producto
        $setenece = "UPDATE producto SET estatus = 0 WHERE codproducto = '".$codproducto."' ";
        $conexion->query($setenece) or die ("Error al buscar en la base de datos: ".mysqli_error($conexion));
        mysqli_close($conexion);
        echo'<script>window.location.href="../Vista/html/inventarios.php";</script>';
    }
    
    
?>