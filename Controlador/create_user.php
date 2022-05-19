<?php
echo'<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>';

    include '../includes/script.php';


newUser($_POST['id'], $_POST['name'], $_POST['user'], $_POST['pass'], $_POST['type'], $_POST['typeId'], $_POST['dir'], $_POST['tel'], $_POST['email'] );
function newUser($id, $name, $user, $pass, $type, $typeId, $dir, $tel, $email){
    
    include '../includes/conexion.php';
        $pass2 = $_POST['pass2'];
        $user = mysqli_real_escape_string($conexion, $user);
        $passmd5 = md5(mysqli_real_escape_string($conexion, $pass));
        $pass2md5 = md5(mysqli_real_escape_string($conexion, $pass2));
    if($passmd5==$pass2md5){
        include '../includes/conexion.php';
        $sentence="SELECT * FROM usuario WHERE id = '".$id."' OR usuario = '".$user."' ";
        $result = $conexion->query($sentence) or die ("Error al Consultar BD: " .mysqli_error($conexion));

        $rows = mysqli_num_rows($result);
        //Validación de password que coinciden
        if ($rows>0){
            echo'<script>
                UserPasswordExists()       
                </script>'; 
        }else if($rows==0){
            include '../includes/conexion.php';
            //query para creación de usuario
            $sentence2 = "INSERT INTO usuario (id, nombre, usuario, clave, rol, tipoId, direccion, telefono, correo) VALUES ('".$id."', '".$name."', '".$user."', '".$passmd5."', '".$type."', '".$typeId."', '".$dir."', '".$tel."', '".$email."' )";
            $conexion->query($sentence2) or die ("Error al crear el usuario: ".mysqli_error($conexion));

            echo'<script>
                UserCreate()       
                </script>'; 
        }mysqli_close($conexion);

    }else{
        echo'<script>
                DiferentPassword()       
                </script>'; 
    }
}
