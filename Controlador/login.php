
<?php
include '../includes/script.php';
Consult($_POST['user'], $_POST['pass']);
function Consult($user, $pass)
{
    include '../includes/conexion.php';
    $user = mysqli_real_escape_string($conexion, $user);
    $pass = md5(mysqli_real_escape_string($conexion, $pass));
    $sentence = "SELECT * FROM usuario WHERE usuario = '" . $user . "' and clave = '" . $pass . "' ";
    $result = $conexion->query($sentence) or die("Error al consultar: " . mysqli_error($conexion));



    $rows = mysqli_num_rows($result); //Numero de filas que devuelve
    mysqli_close($conexion);
    if ($rows > 0) {
        while ($rows = $result->fetch_array()) {
            $rol = $rows['rol'];
            $id = $rows['id'];
            $user = $rows['usuario'];
        }

        session_start();
        $_SESSION['active'] = true;
        $_SESSION['rol'] = $rol;
        $_SESSION['id'] = $id;
        $_SESSION['usuario'] = $user;
        header('Location: ../Vista/html/panel_principal.php');
    } else {
        
        echo '<script>
            WrongPassword()
            </script>';

        
    }
}

?>