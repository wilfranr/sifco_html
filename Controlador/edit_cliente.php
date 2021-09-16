<?php
    include '../includes/script.php';
    editCliente($_POST['id'], $_POST['name'], $_POST['typeId'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
    function editCliente($id, $name, $typeId, $dir, $tel, $email){
        
            include '../includes/conexion.php';
            $sentence="UPDATE cliente SET id = '".$id."', nombre = '".$name."', tipoId = '".$typeId."', direccion = '".$dir."', telefono = '".$tel."', correo = '".$email."' WHERE id = '".$id."' ";
            $conexion->query($sentence) or die ("Error al modificar el cliente: ".mysqli_error($conexion));
            mysqli_close($conexion);

            echo'<script>
                ClientModify()       
                </script>'; 
        

    }




?>