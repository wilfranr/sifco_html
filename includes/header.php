<!DOCTYPE html>
<?php
include 'script.php';
include 'conexion.php';

session_start();
if (empty($_SESSION['active'])) {
    echo '<script type="text/javascript" src="../../Vista/js/functions.js"></script>';
    echo '<script>
            UserNoAccess()
        </script>';
}

$id = $_SESSION['id'];
$sentence = "SELECT nombre, rol, codUsuario FROM usuario WHERE id = '" . $id . "' ";
$result = $conexion->query($sentence);
$row = $result->fetch_assoc();
$usuario_id = $row['codUsuario'];
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../../font.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">

        <div class="container-fluid">
            <a class="navbar-brand" href="panel_principal.php"><img src="../img/LOGO_gris.png" alt="logo" width="130px"></a>

            <h4 id="user">
                <?php
                echo utf8_decode($row['rol']);
                echo ": ";
                echo utf8_decode($row['nombre']);
                ?>
                <a href="../../Controlador/exit.php" class="icon-salir icon-exit"></a>
            </h4>
            <div class="redes">
                <ul>
                    <li>
                        <a href="https://es-es.facebook.com/" class="icon icon-facebook2" target="blank"></a>
                        <a href="https://twitter.com/" class="icon icon-twitter" target="blank"></a>
                        <a href="https://www.youtube.com/" class="icon icon-youtube" target="blank"></a>
                        <a href="https://www.whatsapp.com" class="icon icon-whatsapp" target="blank"></a>

                    </li>
                </ul>
            </div>


        </div>
    </nav>
</body>

</html>