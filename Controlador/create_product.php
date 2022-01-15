<?php

include '../includes/script.php';
$cod = $_SESSION['id'];
echo $cod;

newProduct($_POST['nombre'], $_POST['descripcion'], $_POST['costo'], $_POST['precio'], $_POST['cantidad'], $_POST['fechavence'], $_POST['foto'],$row['codUsuario']);
function newProduct($nombre,$descripcion, $costo, $precio, $cantidad, $fechavence, $foto, $id){
    
    
        
            include '../includes/conexion.php';
            $sentence2 = "INSERT INTO producto (nombre, descripcion, costo, precio, existencia, fechaVencimiento, foto, usuario_id) VALUES ( '".$nombre."', '".$descripcion."', '".$costo."', '".$precio."', '".$cantidad."', '".$fechavence."', '".$foto."', '".$id."'  )";
            $conexion->query($sentence2) or die ("Error al crear el producto: ".mysqli_error($conexion));

            echo'<script>
                ProductCreate()       
                </script>'; 
        }mysqli_close($conexion);

    


?>


