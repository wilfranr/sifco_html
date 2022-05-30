<?php
    include '../includes/script.php';
    editUser($_POST['id'], $_POST['nit'], $_POST['name'], $_POST['razon_social'], $_POST['tel'], $_POST['dir'], $_POST['email'], $_POST['iva'] );
    function editUser($id, $nit, $name, $razon_social, $tel, $dir, $email,$iva){
        
            include '../includes/conexion.php';
            $sentence="UPDATE configuracion SET nombre = '".$name."', nit = '".$nit."', razon_social = '".$razon_social."', direccion = '".$dir."', telefono = '".$tel."', email = '".$email."', iva ='".$iva."' WHERE id = '".$id."' ";
            $conexion->query($sentence) or die ("Error al modificar la empresa: ".mysqli_error($conexion));
            
            mysqli_close($conexion);

            echo'<script>
                EmpresaModify()       
                </script>'; 
            
        

    }
