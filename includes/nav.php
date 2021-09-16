<?php
if($_SESSION['rol'] == 'Vendedor'){
  ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    
</head>
    

<body>
    <!--barra navegación-->

    <div class="container-accesos" id="container-accesos">
        <nav class="navigation-accesos" >
            <ul>
                <li><a href="panel_principal.php">INICIO</a></li>
                <li><a href="ventas.php">VENTAS</a></li>
                <li><a href="compras.php">COMPRAS</a></li>
                <li><a href="clientes.php">CLIENTES</a></li>
                <li><a href="proveedores.php">PROVEEDORES</a></li>
                <li><a href="inventarios.php">INVENTARIO</a></li>
                <li><a href="ayuda.php">AYUDA</a></li>
                
            </ul>
        </nav>
    </div>
    
</body>
</html>
<?php } else{?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="font.css">
        
    </head>
        
    
    <body>
        <!--barra navegación-->
    
        <div class="container-accesos" id="container-accesos">
            <nav class="navigation-accesos" >
                <ul>
                    <li><a href="panel_principal.php">INICIO</a></li>
                    <li><a href="ventas.php">VENTAS</a></li>
                    <li><a href="compras.php">COMPRAS</a></li>
                    <li><a href="clientes.php">CLIENTES</a></li>
                    <li><a href="proveedores.php">PROVEEDORES</a></li>
                    <li><a href="reportes.php">REPORTES</a></li>
                    <li><a href="inventarios.php">INVENTARIO</a></li>
                    <li><a href="usuarios.php">USUARIOS</a></li>
                    <li><a href="ayuda.php">AYUDA</a></li>
                    
                </ul>
            </nav>
        </div>
        
    </body>
    </html>
<?php   
}

?>