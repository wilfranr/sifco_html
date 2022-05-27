<?php
include '../includes/script.php';
    editUser($_POST['pass'], $_POST['id'], $_POST['pass-old']);
    function editUser($pass, $id, $pass_old){
        include '../includes/conexion.php';
    
        $pass_old = $_POST['pass-old'];
        $pass2 = $_POST['pass2'];
        $passmd5 = md5(mysqli_real_escape_string($conexion, $pass));
        $pass2md5 = md5(mysqli_real_escape_string($conexion, $pass2));
        $pass_old = md5(mysqli_real_escape_string($conexion, $pass_old));
        
        
        if ($passmd5==$pass2md5){//verificación de que los password coincidan

            $sentence_pass = "SELECT clave FROM usuario WHERE id = '".$id."'";
            $result_pass = $conexion->query($sentence_pass) or die ("Error al consultar: ".mysqli_error($conexion));
            $rows_pass = $result_pass->fetch_assoc();
            $pass_old2 = $rows_pass['clave'];
            if ($pass_old2 == $pass_old){//verificación de que el password anterior coincida) {
                
            

            
            
            $sentence="UPDATE usuario SET clave = '".$passmd5."' WHERE id = '".$id."' AND clave = '".$pass_old."'";
            $conexion->query($sentence) or die ("Error al modificar password: ".mysqli_error($conexion));
            mysqli_close($conexion);

            echo'<script>
                    PasswordEdit()       
                </script>'; 
            }else{
                echo'<script>
                    PasswordIncorrect()
                </script>'; 
            }
        }
        else{
            echo'<script>
                    DiferentPassword()       
                </script>'; 
        }

    }
