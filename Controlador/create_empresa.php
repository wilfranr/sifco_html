<?php

include '../includes/script.php';

newCliente($_POST['nit'], $_POST['name'], $_POST['razon_social'], $_POST['dir'], $_POST['tel'], $_POST['email'], $_POST['iva'] );
function newCliente($nit,$name, $razon_social, $dir, $tel, $email, $iva){
    
    
        include '../includes/conexion.php';
        $sentence="SELECT * FROM configuracion WHERE nit = '".$nit."' ";
        $result = $conexion->query($sentence) or die ("Error al Consultar BD: " .mysqli_error($conexion));

        $rows = mysqli_num_rows($result);
        if ($rows>0){//validación de empresa  existente
            echo'<script>
                    EmpresaExist()
                </script>';
        }else if($rows==0){
            include '../includes/conexion.php';
            //Creando proveedor
            $sentence2 = "INSERT INTO configuracion (nit, nombre, razon_social, direccion, telefono, email, iva) VALUES ( '".$nit."', '".$name."', '".$razon_social."', '".$dir."', '".$tel."', '".$email."', '".$iva."' )";
            $conexion->query($sentence2) or die ("Error al crear la empresa: ".mysqli_error($conexion));

            echo'<script>
                    EmpresaCreate()    
                </script>'; 
        }mysqli_close($conexion);

    
}

?>


