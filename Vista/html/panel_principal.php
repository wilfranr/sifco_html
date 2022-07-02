<?php
include '../..//includes/header.php';
include '../..//includes/conexion.php';
include '../../includes/script.php';
if ($_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Vendedor' || $_SESSION['rol'] == 'Superusuario') {

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
            <div class="col card-usuarios">
                <a href="Nueva_venta.php"><img src="../img/VENTAS.png" alt="ventas" width="200px"></a>
                <h4>VENTAS</h4>
            </div>
            <div class="col card-usuarios">
                <a href="inventarios.php"><img src="../img/inventario.png" alt="inventario" width="200px"></a>
                <h4>INVENTARIO</h4>
            </div>
            <div class="col card-usuarios">
                <a href="clientes.php"><img src="../img/CLIENTES.png" alt="clientes" width="200px"></a>
                <h4>CLIENTES</h4>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly ">
        <div class="row mt-5 text-center">
            <div class="col card-usuarios card-usuarios">
                <a href="proveedores.php"><img src="../img/PROVEEDORES.png" alt="proveedores" width="200px"></a>
                <h4>PROVEEDORES</h4>
            </div>
            <div class="col card-usuarios card-restricted">
                <a href="usuarios.php"><img src="../img/USUARIOS.png" alt="usuarios" width="200px"></a>
                <h4>USUARIOS</h4>
            </div>
            <div class="col card-usuarios card-config">
                <a href="configuracion.php"><img src="../img/settings.png" alt="configuracion" width="200px"></a>
                <h4>CONFIGURACIÓN</h4>
            </div>
            <div class="col card-usuarios">
                <a href="ayuda.php"><img src="../img/AYUDA.png" alt="ayuda" width="200px"></a>
                <h4>AYUDA</h4>
            </div>
        </div>
    </div>


    <?php
    //Validación de elementos que se muestran segun rol de usuario
    if ($_SESSION['rol'] == 'Vendedor' ) {
    ?>
        <style>
            .card-restricted {
                display: none !important;
            }
            .card-config {
                display: none !important;
            }
        </style>
    <?php } ?>
    <?php
    //Validación de elementos que se muestran segun rol de usuario
    if ($_SESSION['rol'] == 'Administrador' ) {
    ?>
        <style>
            .card-config {
                display: none !important;
            }
        </style>




</body>

<?php }
include '../../includes/footer.php';

}
?>

</html>