<?php
include '../includes/conexion.php';
    $search= ($_REQUEST['search']);
    $sentence="SELECT * FROM producto WHERE codproducto = '".$search."'";
            $result = $conexion->query($sentence) or die ("Error al consultar: " .mysqli_error($conexion));
            
            
            while($rows = $result->fetch_array())
            {
                echo $rows['descripcion'];
            }

?>