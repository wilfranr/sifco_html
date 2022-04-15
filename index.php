<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

    <title>SIFCO-INICIO SESION</title>
</head>

<!--redes sociales y logo-->
<nav class="navbar navbar-dark bg-dark fixed-top">
        
        <div class="container-fluid">
            <a class="navbar-brand"><img src="./Vista/img/LOGO_gris.png" alt="logo" width="130px"></a>
            
            
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

<body>

    <!--Formulario de inicio de sesión-->
    <div class="inicio_sesion">

        <div class="logo2">
            <img src="Vista/img/LOGO_gris.png" alt="logo2" width="100%">
        </div>
        <nav class="acceder">
            <div class="login-contenido" id="formulario">
                <div id="ingresar" style="color: #2471A3">INGRESAR</div><br>
                <form class="form-ingresar" action="Controlador/login.php" method="post">
                    <input class="control" type="text" name="user" placeholder="Ingrese su Usuario" required><br>
                    <input class="control" type="password" name="pass" placeholder="Ingrese su contraseña" required><br>
                    <input class="boton" type="submit" value="Acceder"><br><br>

                </form>

            </div>

        </nav>

    </div>
</body>
<!--pie de página-->

<?php include 'includes/footer.php';
    include 'includes/script.php'
?>

</html>