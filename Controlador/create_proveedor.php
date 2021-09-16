<?php
echo'<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>';

include '../includes/script.php';

newCliente($_POST['proveedor'], $_POST['id'], $_POST['typeId'], $_POST['contacto'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
function newCliente($proveedor,$id, $typeId, $contacto, $dir, $tel, $email){
    
    
        include '../includes/conexion.php';
        $sentence="SELECT * FROM proveedor WHERE proveedor = '".$proveedor."' ";
        $result = $conexion->query($sentence) or die ("Error al Consultar BD: " .mysqli_error($conexion));

        $rows = mysqli_num_rows($result);
        if ($rows>0){
            echo'<script>
                    IdExist()
                </script>';
        }else if($rows==0){
            include '../includes/conexion.php';
            $sentence2 = "INSERT INTO proveedor (proveedor, id, tipoIdProveedor, contacto, direccion, telefono, correo) VALUES ( '".$proveedor."', '".$id."', '".$typeId."', '".$contacto."', '".$dir."', '".$tel."', '".$email."' )";
            $conexion->query($sentence2) or die ("Error al crear el proveedor: ".mysqli_error($conexion));

            echo'<script>
                ProviderCreate()       
                </script>'; 
        }mysqli_close($conexion);

    
}

?>


