<?php
include '../includes/script.php';
    editUser($_POST['pass'], $_POST['id']);
    function editUser($pass, $id){
        include '../includes/conexion.php';
    
        $pass2 = $_POST['pass2'];
        $passmd5 = md5(mysqli_real_escape_string($conexion, $pass));
        $pass2md5 = md5(mysqli_real_escape_string($conexion, $pass2));
        
        
        if ($passmd5==$pass2md5){
            
            $sentence="UPDATE usuario SET clave = '".$passmd5."' WHERE id = '".$id."' ";
            $conexion->query($sentence) or die ("Error al modificar password: ".mysqli_error($conexion));
            mysqli_close($conexion);

            echo'<script>
                    PasswordEdit()       
                </script>'; 
        }
        else{
            echo'<script>
                    DiferentPassword()       
                </script>'; 
        }

    }
