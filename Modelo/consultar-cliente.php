<?php
    include 'includes/conexion.php';
    include 'includes/header.php';
    include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <title>SIFCO-WEB</title>
</head>

<!--redes sociales y logo-->
<header class="header1">
        
    <div class="container">
        <a class="logo" href="inicio.html"><img src="img/LOGO_gris.png" alt="logo" width="130px"></a>
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

<body>
    <!--barra navegación-->

    <div class="container-accesos">
        <nav class="navigation-accesos" >
            <ul>
                <li><a href="panel_principal.html">INICIO</a></li>
                <li><a href="ventas.html">VENTAS</a></li>
                <li><a href="compras.html">COMPRAS</a></li>
                <li id="clientes"><a href="clientes.html">CLIENTES</a></li>
                <li><a href="proveedores.html">PROVEEDORES</a></li>
                <li><a href="reportes.html">REPORTES</a></li>
                <li><a href="inventarios.html">INVENTARIO</a></li>
                <li><a href="usuarios.html">USUARIOS</a></li>
                <li><a href="ayuda.html">AYUDA</a></li>
                <li><a href="inicio.html">CERRAR SESION</a></li>
            </ul>
    
        </nav>
    </div>
    <!--formulario consultar cliente-->
   <div class="consulta-cliente"><h1>CONSULTAR CLIENTE</h1></div>
   <div class="formulario-consulta-cliente">
       <form action="">
           
            <label for="Tipo_Id">Tipo de Id.</label>
            <select name="Tipo-id" id="tipo-id">
                <option disabled value="">Seleccione una opcion</option>
                <option value="Cedula">Cédula de Ciudadanía</option>
                <option value="Cedula-ext">Cédula de Extranjería</option>
                <option value="Nit">Nit</option>
            </select><br><br>
            <label for="Id_Cli">Id Cliente (Nit-CC)</label>
            <input class="control-registro" type="number"><br><br>
            <label for="Nom_Cli">Nombres</label>
            <input class="control-registro" type="text"><br><br>
            
            <a href="javascript:abrir6()"><input class="boton-consultar" type="button" value="CONSULTAR"></a>
            <a href="clientes.html"><input class="boton-cancelar" type="button" value="CANCELAR"></a>
       </form>
       
   </div>
   

    
    <div class="cuadro-consulta-cliente" id="cuadro-consulta-cliente">
        Tipo Id: <br><br>
        Id Cliente: <br><br>
        Nombres: <br><br>
        Apellidos: <br><br>
        Direccion: <br><br>
        Teléfono: <br><br>
        Email: <br><br>

        <div class="boton-aceptar">
            <a href="consultar-cliente.html"><button id="btn-aceptar">ACEPTAR</button></a>
        </div>

    </div>
   
    <script>
        
        function abrir6(){
            document.getElementById("cuadro-consulta-cliente").style.display="block";

        }
        
    </script>

</body>
<?php include 'footer.php' ?>

</html>