<?php
include '../..//includes/header.php';
include '../..//includes/conexion.php';
include '../../includes/script.php'

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
    <div class="d-flex justify-content-evenly">
        <div class="row mt-5 text-center">
            <div class="col">
                <a href="Nueva_venta.php"><img src="../img/VENTAS.png" alt="ventas" width="200px"></a>
                <h4>VENTAS</h4>
            </div>
            <div class="col">
                <a href="inventarios.php"><img src="../img/inventario.png" alt="inventario" width="200px"></a>
                <h4>INVENTARIO</h4>
            </div>
            <div class="col">
                <a href="clientes.php"><img src="../img/CLIENTES.png" alt="clientes" width="200px"></a>
                <h4>CLIENTES</h4>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly ">
        <div class="row mt-5 text-center">
            <div class="col">
                <a href="proveedores.php"><img src="../img/PROVEEDORES.png" alt="proveedores" width="200px"></a>
                <h4>PROVEEDORES</h4>
            </div>
            <div class="col">
                <a href="usuarios.php"><img src="../img/USUARIOS.png" alt="usuarios" width="200px"></a>
                <h4>USUARIOS</h4>
            </div>
            <div class="col">
                <a href="ayuda.php"><img src="../img/AYUDA.png" alt="ayuda" width="200px"></a>
                <h4>AYUDA</h4>
            </div>
        </div>
    </div>


    <?php
    if ($_SESSION['rol'] == 'Vendedor') {
    ?>
        <style>
            .card-usuarios,
            .card-reportes {
                display: none;
            }
        </style>
    <?php } ?>




</body>

<?php include '../../includes/footer.php' ?>

</html>