<?php
    include 'includes/header.php';
    include 'includes/nav.php';
    include 'includes/footer.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <title>SIFCO-WEB</title>
</head>



<body>
    
<!--tabla de venta-->

<div class="medio-pago">
    
    <div class="boton-pago">
        <a href="javascript:abrir()"><img src="img/efectivo.png" alt="efectivo" width="50%"></a>
        <h4>EFECTIVO</h4>
    </div>
        
    <div class="boton-pago">
        <a href="javascript:abrir3()"><img src="img/tarjeta.png" alt="tarjeta" width="50%"></a>
        <h4>TARJETA</h4>
    </div>


    <div id="medio"><br> MEDIO DE PAGO</div>

    

</div>        
<!--tabla de facturacion-->
<div class="container-tabla">
            <h1>FACTURA DE VENTA</h1><br><br>
            <table class="tabla-venta">
                <tr>
                <th>Cod.Artículo</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Valor Unidad</th>
                <th>Valor Total</th></tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td></td>
            <td></td> </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td><h1>TOTAL A PAGAR</h1></td><td></td></tr>
            </table>
        
        
</div>

    <!--Cuadro de pago-->

    <section>
        <div class="cuadro-pago" id="cuadro-pagar" >
            <form action="" class="pago">
                <label for="TOTAL A PAGAR">TOTAL A PAGAR:</label><br><br>
                <label for="PAGA CON">PAGA CON:    </label>
                <input class="control-pago" type="text" placeholder="$0"><br><br>
                <label for="cambio">CAMBIO:    </label>
                
            </form>
            <div class="boton-pagar" >
                <a  href="javascript:abrir2()" ><img src="/img/ACEPTAR.png" alt="ACEPTAR" width="30%"></a>
                <a  href=""><img src="/img/CANCELAR.png" alt="CANCELAR" width="80%"></a>
            </div>
            
        </div>
    </section>
    <div class="tarjeta-pago" id="tarjeta-pagar" >
        
        <div >
            <h1>TOTAL A PAGAR:</h1><br>
            <h2>0$</h2><br>
            <a  href="javascript:abrir2()" ><img src="/img/ACEPTAR.png" alt="ACEPTAR" width="15%"></a>
            <a  href=""><img src="/img/CANCELAR.png" alt="CANCELAR" width="15%"></a>
        </div>
        
    </div>
    <section>

    </section>

    <section>
        <div class="pago-exitoso" id="pagar-exitoso">
            <h1>PAGO EXITOSO¡¡¡</h1>
            <a href="ventas.html"><img src="/img/ACEPTAR.png" alt="ACEPTAR" width="20%"></a>
        </div>
    </section>

    <script>
        function abrir(){
            document.getElementById("cuadro-pagar").style.display="block";

        }
        function cerrar(){
            document.getElementById("cuadro-pagar").style.display="none";

        }
        function abrir2(){
            document.getElementById("pagar-exitoso").style.display="block";
            document.getElementById("cuadro-pagar").style.display="none";
            document.getElementById("tarjeta-pagar").style.display="none";
            
            
        }
        function abrir3(){
            document.getElementById("tarjeta-pagar").style.display="block";
        }


        
    </script>
    

    
    

</body>
<?php include 'includes/footer.php' ?>

</html>