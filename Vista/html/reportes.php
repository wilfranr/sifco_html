<?php
    include '../../includes/header.php';
    include '../../includes/conexion.php';
    include '../../includes/nav.php';
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
                <label class="control-reporte" for="fecha-inicio">Fecha de inicio</label>
                <input type="date"><br><br>
                <label class="control-reporte" for="fecha-final">Fecha Final</label>
                <input type="date"><br><br><br>
                <a href="javascript:abrir9()"><input class="boton-consultar" type="button" value="CONSULTAR"></a>
                <a href="reportes.html"><input class="boton-cancelar" type="button" value="CANCELAR"></a>
                
            </form>

        </div>
        
    
    <!--reporte generado-->

    <div class="tabla-reporte" id="tabla-reporte">

            <div class="container-tabla-reporte">
            <h1>REPORTE</h1>
            <table class="tabla-venta">
                <tr>
                <th>ÍTEM</th>
                <th>FECHA</th>
                <th>COD. ART</th>
                <th>NOMBRE</th>
                <th>CANT.</th>
                <th>STOCK DISP.</th>
                <th>VALOR UNI.</th>
                <th>VALOR TOTAL</th></tr>
                <tr class="impar">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="par">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="impar">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="par">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="impar">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="par">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="impar">
                <td></td>
                <td></td>
                <td></td><td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="par">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> </tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="total-a-pagar">TOTAL A PAGAR</td>
                <td></td></tr>
            </table>
            </div>
            <div class="imprimir-descargar">
                <a href=""><img src="img/descargar.png" alt="descargar" width="100%"></a>DESCARGAR<br><br><br>
                <a href="" onclick="window.print()"><img src="img/imprimir.png" alt="imprimir" width="100%"></a>IMPRIMIR <br><br>
                <a href="reportes.html"><img src="img/CANCELAR.png" alt="cancelar" width="40%"></a>

                
            </div>
    </div>
    <script>
        
        function abrir9(){
            document.getElementById("tabla-reporte").style.display="block";
            document.getElementById("generar-reporte-ventas").style.display="none";
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
<?php include '../../includes/footer.php' ?>
</html>