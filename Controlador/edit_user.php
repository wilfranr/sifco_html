<?php
    include '../includes/script.php';
    editUser($_POST['id'], $_POST['name'], $_POST['user'], $_POST['type'], $_POST['typeId'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
    function editUser($id, $name, $user, $type, $typeId, $dir, $tel, $email){
        
            include '../includes/conexion.php';
            $sentence="UPDATE usuario SET nombre = '".$name."', usuario = '".$user."', rol = '".$type."', tipoId = '".$typeId."', direccion = '".$dir."', telefono = '".$tel."', correo = '".$email."' WHERE id = '".$id."' ";
            $conexion->query($sentence) or die ("Error al modificar el usuario: ".mysqli_error($conexion));
            mysqli_close($conexion);

            echo'<script>
                UserModify()       
                </script>'; 
            
        

    }
