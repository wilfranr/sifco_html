<?php
echo'<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>';
include '../includes/script.php';

newCliente($_POST['id'], $_POST['name'], $_POST['typeId'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
function newCliente($id, $name, $typeId, $dir, $tel, $email){
    
    
        include '../includes/conexion.php';
        $sentence="SELECT * FROM cliente WHERE id = '".$id."' ";
        $result = $conexion->query($sentence) or die ("Error al Consultar BD: " .mysqli_error($conexion));

        $rows = mysqli_num_rows($result);
        if ($rows>0){
            echo'<script>
                    IdExist()
                </script>';
        }else if($rows==0){
            include '../includes/conexion.php';
            $sentence2 = "INSERT INTO cliente (id, nombre, tipoId, direccion, telefono, correo) VALUES ('".$id."', '".$name."', '".$typeId."', '".$dir."', '".$tel."', '".$email."' )";
            $conexion->query($sentence2) or die ("Error al crear el usuario: ".mysqli_error($conexion));

            echo'<script>
                ClientCreate()       
                </script>'; 
        }mysqli_close($conexion);

    
}

?>


