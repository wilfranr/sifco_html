
<?php 
    session_start();
    if(empty($_SESSION['active'])){
        echo'<script>
            UserNoAccess()
        </script>'; 
    }
    include 'conexion.php';
    $id = $_SESSION['id'];
    $sentence = "SELECT nombre, rol FROM usuario WHERE id = '".$id."' ";
    $result = $conexion->query($sentence);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../../font.css">
    
    
</head>
<body>
<header class="header1">
    <div class="container">
    
        <a class="logo" href="../../index.php"><img src="../img/LOGO_gris.png" alt="logo" width="130px"></a>
        <h4 id="user" >
         <?php 
            echo utf8_decode($row['rol']);
            echo ": "; 
            echo utf8_decode($row['nombre']); 
             ?>
             <a href="../../Controlador/exit.php" class="icon-salir icon-exit" ></a>
            </h4>
            
        
        <nav class="redes"> 
            <ul>
                <li>
                    <a href="https://es-es.facebook.com/" class="icon icon-facebook2" target="blank"></a>
                    <a href="https://twitter.com/" class="icon icon-twitter" target="blank"></a>
                    <a href="https://www.youtube.com/" class="icon icon-youtube" target="blank"></a>
                    <a href="https://www.whatsapp.com" class="icon icon-whatsapp" target="blank"></a>
                    
                    
                </li>
            </ul>
        </nav> 
    </div>
</header>
</body>

</html>