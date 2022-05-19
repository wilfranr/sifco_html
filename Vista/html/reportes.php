<?php
include '../../includes/header.php';
include '../../includes/conexion.php';
include '../../includes/nav.php';
include '../../includes/script.php';
if ($_SESSION['rol'] == 'Administrador') {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Reportes</title>
    </head>

    <!--Cuadro para generar reportes-->
    <div class="generar-reporte" id="generar-reporte-ventas">
        <H1>GENERAR REPORTES</H1><br><br>

        <form class="formulario-reporte">
            <label class="control-reporte" for="tipo-reporte">Tipo de Reporte</label>
            <select name="tipo-reporte">
                <option disabled value="">Seleccione una opcion</option>
                <option value="ventas">Ventas</option>
                <option value="Compras">Compras</option>
                <option value="clientes">Clientes</option>
                <option value="proveedores">Proveedores</option>
                <option value="balances">balances</option>
            </select><br><br>
            <label class="control-reporte" for="fecha-inicio" id="fecha-inicio">Fecha de inicio</label>
            <input type="date"><br><br>
            <label class="control-reporte" for="fecha-final" id="fecha-final">Fecha Final</label>
            <input type="date"><br><br><br>
            <a href="javascript:abrir9()"><input class="btn btn-primary boton-consultar" type="button" value="CONSULTAR"></a>
            <a href="reportes.php"><input class="btn btn-danger boton-cancelar" type="button" value="CANCELAR"></a>

        </form>

    </div>




    <!--reporte generado-->

    <div class="tabla-reporte" id="tabla-reporte">

        <div class="container-tabla-reporte">
            <h1>REPORTE</h1>
            <table class="tabla-venta">
                <tr>
                    <th>Factura No.</th>
                    <th>FECHA</th>
                    <th>USUARIO</th>
                    <th>CLIENTE</th>
                    <th>TOTAL FACTURADO</th>
                    <th>ACCIÓN</th>
                </tr>


                
                <?php
            $sentence="SELECT * FROM factura ORDER BY fecha ";
            $result = $conexion->query($sentence) or die ("Error al consultar: " .mysqli_error($conexion));
            mysqli_close($conexion);
            
            while($rows = $result->fetch_assoc())
            {
        ?>
                <tr class="impar">
                    <td class="py-3"><?php echo $rows['nofactura'] ?></td>
                    <td><?php echo $rows['fecha'] ?></td>
                    <td><?php echo $rows['usuario'] ?></td>
                    <td><?php echo $rows['codcliente'] ?></td>
                    <td>$<?php echo $rows['totalfactura'] ?></td>
                    <td><div class="btn btn-primary"><i class="bi bi-eye-fill"></i></div></td>
                    
                    <?php
                }
                ?>
                </tr>
            </table>
        </div>
        <div class="imprimir-descargar">
            <a href="" onclick="window.print()"><img src="../img/imprimir.png" alt="imprimir" width="100%"></a>IMPRIMIR <br><br>
            <a href="reportes.php" class="btn btn-danger"><img src="img/CANCELAR.png" alt="cancelar" width="40%"></a>


        </div>
    </div>
    <script>
        function abrir9() {
            document.getElementById("tabla-reporte").style.display = "block";
            document.getElementById("generar-reporte-ventas").style.display = "none";
        }
    </script>

    </body>
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
<?php include '../../includes/footer.php';
} else {
    echo '<script type="text/javascript" src="../js/functions.js"></script>';
    echo '<script>

            UserNoAccess()
        </script>';
}
?>

    </html>