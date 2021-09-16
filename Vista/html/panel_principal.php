<?php
    include '../..//includes/header.php';
    include '../..//includes/conexion.php';   
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Panel Principal</title>
</head>


<body>
    
    
<!--panel de control-->
    <div class="container-card">
        <div class="card">
            <a href="ventas.php"><img src="../img/VENTAS.png" alt="ventas"></a>
            <h4>VENTAS</h4>
        </div><br><br>

        <div class="card">
            <a href="compras.php"><img src="../img/COMPRAS.png" alt="compras"></a>
            <h4>COMPRAS</h4><br><br>
        </div>

        <div class="card">
            <a href="clientes.php"><img src="../img/CLIENTES.png" alt="clientes"></a>
            <h4>CLIENTES</h4><br><br>
        </div>

        <div class="card">
            <a href="proveedores.php"><img src="../img/PROVEEDORES.png" alt="proveedores"></a>
            <h4>PROVEEDORES</h4>
        </div>
    
    </div>

    <div class="container-card">
        <div class="card-reportes">
            <a href="reportes.php"><img src="../img/REPORTES.png" alt="reportes"></a>
            <h4>REPORTES</h4><br><br><br>
        </div>

        <div class="card-usuarios">
            <a href="usuarios.php"><img src="../img/USUARIOS.png" alt="usuarios"></a>
            <h4>USUARIOS</h4><br><br><br>
        </div>

        <div class="card">
            <a href="inventarios.php"><img src="../img/inventario.png" alt="inventario"></a>
            <h4>INVENTARIO</h4><br><br><br>
        </div>
        
        <div class="card">
            <a href="ayuda.php"><img src="../img/AYUDA.png" alt="ayuda"></a>
            <h4>AYUDA</h4>
        </div>
    
    
    </div>
    <?php
        if($_SESSION['rol'] == 'Vendedor'){
            ?>
          <style>.card-usuarios, .card-reportes{display: none;}</style>  
          <?php } ?>
        
    
    

</body>

<?php include '../../includes/footer.php' ?>
</html>