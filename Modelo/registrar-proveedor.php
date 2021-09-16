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
                <li><a href="clientes.html">CLIENTES</a></li>
                <li id="proveedores"><a href="proveedores.html">PROVEEDORES</a></li>
                <li><a href="reportes.html">REPORTES</a></li>
                <li><a href="inventarios.html">INVENTARIO</a></li>
                <li><a href="usuarios.html">USUARIOS</a></li>
                <li><a href="ayuda.html">AYUDA</a></li>
                <li><a href="inicio.html">CERRAR SESION</a></li>
            </ul>
    
        </nav>
    </div>
    
   <div class="registro-proveedor"><h1>REGISTRAR PROVEEDOR</h1></div>
   <div class="formulario-registro-proveedor">
       <form action="">
           
            <label for="Tipo_Id">Tipo de Id.</label>
            <select name="Tipo-id" id="tipo-id">
                <option disabled value="">Seleccione una opcion</option>
                <option value="Cedula">Cédula de Ciudadanía</option>
                <option value="Cedula-ext">Cédula de Extranjería</option>
                <option value="Nit">Nit</option>
            </select><br><br>
            <label for="Id_Cli">Id Proveedor (Nit-CC)</label>
            <input class="control-registro" type="number"><br><br>
            <label for="Nom_Cli">Nombres</label>
            <input class="control-registro" type="text"><br><br>
            <label for="Ape_Cli">Apellidos</label>
            <input class="control-registro" type="text"><br><br>
            <label for="Dir_Cli">Dirección</label>
            <input class="control-registro" type="text"><br><br>
            <label for="Tel_Cli">Teléfono</label>
            <input class="control-registro" type="text"><br><br>
            <label for="email">Email</label>
            <input class="control-registro" type="text"><br><br>
            <a href="javascript:abrir7()"><input class="boton-agregar2" type="button" value="AGREGAR"></a>
            <a href="proveedores.html"><input class="boton-cancelar2" type="button" value="CANCELAR"></a>
       </form>
       
   </div>
   <section>
    <div class="proveedor-agregado" id="proveedor-agregado">
        <h1>PROVEEDOR REGISTRADO CON EXITO¡¡¡</h1>
        <a href="registrar-proveedor.html"><img src="/img/ACEPTAR.png" alt="ACEPTAR" width="20%"></a>
    </div>
    </section>

    <script>
        function abrir7(){
                document.getElementById("proveedor-agregado").style.display="block";
            }
    </script>
   
       

</body>

<footer>
    
    Derecho Reservados &copy; 2020 <br>
    Elaborado por: Yoseth Rivera <br>
    E-mail: wilfranr@misena.edu.co <br>
    www.sena.edu.co

</footer>
</html>