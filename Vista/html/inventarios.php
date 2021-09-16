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
    
    
    <title>Inventarios</title>
</head>

    

<body>
    
    
    <!--Formulario para consulta de inventario-->

    <div class="titulo-inventario" id="titulo-inventario">
       
        <div class="container-inventario">
       <form action="" class="inventario">
           <label for="consulta-codigo">Consulta por Código</label><br>
           <input class="control-inventario" type="number"><br><br>
           <label for="consulta-nombre">Consulta por Nombre</label>
           <input class="control-inventario" type="text"><br><br>
           <label for="consulta-palabra">Consulta por Palabra Clave</label>
           <input class="control-inventario" type="text"><br><br>
           <input class="boton-consultar" type="button" value="CONSULTAR">
           <a href="javascript:abrir10()"><input class="boton-cancelar" type="button" value="AGREGAR"></a>

        </form>
        </div>
   
   </div>
   <div class="container-tabla-inventario" id="container-tabla-inventario">

    <table class="tabla-venta">
        <br><br>
        <h1>INVENTARIO</h1><br><br>
        <tr>
        <th>ÍTEM</th>
        <th>COD. ART</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>STOCK DISP.</th>
        <th>PRECIO DE COMPRA</th>
        <th>PRECIO VENTA</th>
        <th>DESCUENTO</th>
        <th>FECHA VENC.</th></tr>
        <tr class="impar">
        <td></td>
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
        <td></td>
        <td></td> </tr>
        <tr class="impar"><td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td></tr>
        
    </table>
    <div class="imprimir">
        <a href="" onclick="window.print()"><img src="img/imprimir.png" alt="imprimir" width="100%"></a>IMPRIMIR <br><br>

        
    </div>

    </div>
    <div class="agregar-inventario" id="agregar-inventario">
        <form action="" class="inventario">
            <label for="consulta-codigo">Código Artículo</label>
            <input class="control--agregar-inventario" type="number"><br><br>
            <label for="consulta-nombre">Nombre</label>
            <input class="control--agregar-inventario" type="text"><br><br>
            <label for="consulta-palabra">Proveedor</label>
            <input class="control--agregar-inventario" type="text"><br><br>
            <label for="consulta-palabra">Cantidad</label>
            <input class="control--agregar-inventario" type="number"><br><br>
            <label for="consulta-palabra">Costo</label>
            <input class="control--agregar-inventario" type="text"><br><br>
            <label for="consulta-palabra">Precio</label>
            <input class="control--agregar-inventario" type="text"><br><br>
            <label for="consulta-palabra">Fecha de Expedición</label>
            <input class="control--agregar-inventario" type="date"><br><br>
            <label for="consulta-palabra">Fecha Vencimiento</label>
            <input class="control--agregar-inventario" type="date"><br><br>
            <a href="javascript:abrir11()"><input class="boton-consultar" type="button" value="AGREGAR"></a>
            <a href=""><input class="boton-cancelar" type="button" value="CANCELAR"></a>
 
         </form>

    </div>
    <section>
        <div class="proveedor-agregado" id="proveedor-agregado">
            <h1>ARTÍCULO AGREGADO CON EXITO¡¡¡</h1>
            <a href="inventarios.html"><img src="/img/ACEPTAR.png" alt="ACEPTAR" width="20%"></a>
        </div>
        </section>
    <script>
        function abrir10(){
            document.getElementById("agregar-inventario").style.display="block";
            document.getElementById("titulo-inventario").style.display="none";
            document.getElementById("container-tabla-inventario").style.display="none";
        }
        function abrir11() {
            document.getElementById("proveedor-agregado").style.display="block";
            document.getElementById("agregar-inventario").style.display="none";
            
        }
    </script>
   

</body>
<?php include '../../includes/footer.php' ?>

</html>