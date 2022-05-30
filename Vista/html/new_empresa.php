<?php
    include '../../includes/header.php';
    include '../../includes/conexion.php';
    include '../../includes/nav.php';
    include '../../includes/script.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="font.css">
    <title>Crear Empresa</title>
</head>

<body>
  
    <!--Creación de  usuario-->
    <div class="agregar-usuario" id="modificar-usuario">
    
        <form action="../../Controlador/create_empresa.php" class="inventario" method="POST">
            <h3>CREAR EMPRESA</h3><br>        
            <label for="consulta-palabra">NIT</label>
            <input class="control-usuario" name="nit" type="number" required ><br><br>

            <label for="consulta-codigo">NOMBRE</label>
            <input class="control-usuario" name="name" type="text" required><br><br>

            <label for="consulta-codigo">RAZON SOCIAL</label>
            <input class="control-usuario" name="razon_social" type="text" required><br><br>
            
            <label for="consulta-palabra">DIRECCIÓN</label>
            <input class="control-usuario" name="dir" type="text" ><br><br>
            
            <label for="consulta-palabra">TELÉFONO</label>
            <input class="control-usuario" name="tel" type="text" ><br><br>
            
            <label for="consulta-palabra">EMAIL</label>
            <input class="control-usuario" name="email" type="email" ><br><br>
            
            <label for="consulta-palabra">IVA</label>
            <input class="control-usuario" name="iva" type="number" ><br><br>

            
            <input class="boton-consultar" type="submit" value="CREAR">
            <a href="configuracion.php"><input class="boton-cancelar" type="button" value="CANCELAR"></a> 

         </form>

    </div>
    
</body>

<?php include '../../includes/footer.php' ?>
</html>