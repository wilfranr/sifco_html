<?php
    include '../../includes/conexion.php';
    include '../../includes/header.php';
    include '../../includes/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0">
    
    <title>Ventas</title>
</head>
    

<body>
    
<!--formulario de venta-->
    <div class="container-form">
        <form class="form-venta" action="resumen_venta.php" >
            <label for="cod_art">Código del Artículo</label> 
            <input class="control2" type="number" placeholder="Ingrese código"><br><br>
            <label for="cantidad">Cantidad</label>
            <input class="control2" type="number" placeholder="Ingrese cantidad"><br>
            <input class="boton-agregar" type="submit" value="AGREGAR">
            <a href=""><input class="boton-cancelar" type="button" value="CANCELAR"></a>
        </form>
        
<!--tabla de venta-->
        <div class="container-tabla">
            <h1>RESUMEN DE VENTA</h1>
            <table class="tabla-venta">
                <tr>
                <th>Cod.Artículo</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Valor Unidad</th>
                <th>Valor Total</th></tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="par"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="par"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="par"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="par"><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr class="impar"><td></td>
                <td></td>
                <td></td>
                <td><h1>TOTAL A PAGAR</h1></td><td></td></tr>
            </table>
        </div>
        <section>
            <a href="facturacion.html"> <button id="boton-pagar" >PAGAR</button></a>
        </section>
    </div>


</body>

<?php include '../../includes/footer.php' ?>

</html>