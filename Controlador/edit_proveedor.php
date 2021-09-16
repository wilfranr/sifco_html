<?php
    include '../includes/script.php';
    editCliente($_POST['codproveedor'], $_POST['proveedor'], $_POST['id'], $_POST['typeId'], $_POST['contacto'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
    function editCliente($codproveedor, $proveedor,$id, $typeId, $contacto, $dir, $tel, $email){
        
            include '../includes/conexion.php';
            $sentence="UPDATE proveedor SET codproveedor = '".$codproveedor."', id = '".$id."', tipoIdProveedor = '".$typeId."', proveedor = '".$proveedor."',contacto = '".$contacto."', direccion = '".$dir."', telefono = '".$tel."', correo = '".$email."' WHERE codproveedor = '".$codproveedor."' ";
            $conexion->query($sentence) or die ("Error al modificar el cliente: ".mysqli_error($conexion));
            mysqli_close($conexion);

            echo'<script>
                ProviderModify()       
                </script>'; 
        

    }




?>