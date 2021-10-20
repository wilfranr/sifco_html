<?php
include '../../includes/conexion.php';
include '../../includes/header.php';
include '../../includes/nav.php';
include '../../includes/script.php';
echo '<script type="text/javascript" src="../js/functions.js"></script>';
if ($_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Vendedor') {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Inventario</title>
    </head>

    <body>

        <!--formulario de compra-->
        

            <!-- <form class="form-venta" enctype="multipart/form-data" method="GET" action="">
                <div class="form-title">
                    <h3>AREGAR PRODUCTO</h3><br><br>
                </div>
                <label for="proveedor">Proveedor</label>
                <?php

                $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor");
                $result_proveedor = mysqli_num_rows($query_proveedor);


                ?>
                <select name="proveedor" name="proveedor" class="tipo-option">
                    <?php

                    if ($result_proveedor > 0) {
                        while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                    ?>

                            <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>

                    <?php
                        }
                    } ?>


                </select>
                <a href="new_proveedor.php"> <input class="btn-form" type="button" value="Nuevo"> </a> <br><br>

                <label for="cod_art">Código del Producto</label>

                <input class="control3" value="<?php echo ($_GET['consultar_producto']); ?>" name="consultar_producto" type="number"><input type="submit" value="Buscar" class="btn-form"> <br><br>
                <?php
                if (!empty($_GET['consultar_producto'])) {
                    $consultar_producto = ($_GET['consultar_producto']);


                    $query = "SELECT * FROM producto WHERE codproducto = '" . $consultar_producto . "'";
                    $result_producto = $conexion->query($query) or die("Error al consultar: " . mysqli_error($conexion));
                    $rows = mysqli_num_rows($result_producto);
                    if ($rows > 0) {

                        echo'<script>
                                ProductExists()       
                            </script>'; 

                        $sentence = "SELECT * FROM producto WHERE codproducto = '" . $consultar_producto . "'";
                        $result = $conexion->query($sentence) or die("Error al consultar: " . mysqli_error($conexion));


                        while ($rows = $result->fetch_array()) { ?>
                            <label for="nombre">Nombre</label>
                            <input class="control2" name="nombre" type="text" value="<?php echo $rows['nombre']; ?>"><br>
                            <label for="descripccion">Descripción</label>
                            <input class="control2" name="descripcion" type="text" value="<?php echo $rows['descripcion']; ?>"><br>
                            <label for="precio_compra">Precio de Compra</label>
                            <input class="control2" name="costo" type="text" value="<?php echo $rows['precio']; ?>"><br>
                            <label for="precio-venta">Precio de Venta</label>
                            <input class="control2" name="precio" type="text" value="<?php echo $rows['costo']; ?>"><br>
                            <label for="cantidad">Cantidad</label>
                            <input class="control2" name="cantidad" type="number"><br>
                            <label for="fechaVence">Fecha de Vencimiento</label>
                            <input class="control2" name="fechavece" type="date" value="<?php echo $rows['fechaVencimiento']; ?>"><br>

                            <div class="photo">
                                <label id="foto" for="foto">Foto</label>
                                <div class="prevPhoto">
                                    <span class="delPhoto notBlock">X</span>
                                    <label for="foto"></label>
                                </div>
                                <div class="upimg">
                                    <input type="file" name="foto" id="foto">
                                </div>
                                <div id="form_alert"></div>
                            </div>


                            <input class="boton-agregar" type="submit" value="CREAR">
                            <input class="boton-cancelar" type="button" value="CANCELAR">
            <!-- </form> -->
                        <!-- <?php
                        }
                    } else { ?> -->

                    <!-- <form action="" class="form-venta">
                        <label for="nombre">Nombre</label>
                        <input class="control2" name="nombre" type="text"><br>
                        <label for="descripccion">Descripción</label>
                        <input class="control2" name="descripcion" type="text"><br>
                        <label for="precio_compra">Precio de Compra</label>
                        <input class="control2" name="costo" type="text"><br>
                        <label for="precio-venta">Precio de Venta</label>
                        <input class="control2" name="precio" type="text"><br>
                        <label for="cantidad">Cantidad</label>
                        <input class="control2" name="cantidad" type="number"><br>
                        <label for="fechaVence">Fecha de Vencimiento</label>
                        <input class="control2" name="fechavece" type="date" value="<?php echo $rows['fechaVencimiento']; ?>"><br>

                        <div class="photo">
                            <label for="foto">Foto</label>
                            <div class="prevPhoto">
                                <span class="delPhoto notBlock">X</span>
                                <label for="foto"></label>
                            </div>
                            <div class="upimg">
                                <input type="file" name="foto" id="foto">
                            </div>
                            <div id="form_alert"></div>
                        </div>

                        <input class="boton-agregar" type="submit" value="CREAR">
                        <input class="boton-cancelar" type="button" value="CANCELAR">


                    <?php
                    }
                } else {
                    ?>
                    <label for="nombre">Nombre</label>
                    <input class="control2" name="nombre" type="text"><br>
                    <label for="descripccion">Descripción</label>
                    <input class="control2" name="descripcion" type="text"><br>
                    <label for="precio_compra">Precio de Compra</label>
                    <input class="control2" name="costo" type="text"><br>
                    <label for="precio-venta">Precio de Venta</label>
                    <input class="control2" name="precio" type="text"><br>
                    <label for="cantidad">Cantidad</label>
                    <input class="control2" name="cantidad" type="number"><br>
                    <label for="fechaVence">Fecha de Vencimiento</label>
                    <input class="control2" name="fechavece" type="date" value="<?php echo $rows['fechaVencimiento']; ?>"><br>

                    <div class="photo">
                        <label for="foto">Foto</label>
                        <div class="prevPhoto">
                            <span class="delPhoto notBlock">X</span>
                            <label for="foto"></label>
                        </div>
                        <div class="upimg">
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>

                    <input class="boton-agregar" type="submit" value="CREAR">
                    <input class="boton-cancelar" type="button" value="CANCELAR">

                <?php 
                }
                ?>
            </form> -->

            <!--tabla de compra-->
            <div class="container-tabla">

                <table class="tabla-venta">
                    <h1>INVENTARIO</h1><br><br>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>STOCK DISP.</th>
                        <th>PRECIO DE COMPRA</th>
                        <th>PRECIO VENTA</th>
                        <th>DESCUENTO</th>
                        <th>FECHA VENC.</th>
                        <th>FOTO</th>
                    </tr>
                    <?php
                    //query para paginador
                    $sql_register = mysqli_query($conexion, "SELECT COUNT(*) as total_registro FROM usuario");
                    $result_register = mysqli_fetch_array($sql_register);
                    $total_registro = $result_register['total_registro'];

                    $por_pagina = 10; //numero de registros que se muestran por página

                    if (empty($_GET['pagina'])) {
                        $pagina = 1;
                    } else {
                        $pagina = $_GET['pagina'];
                    }

                    $desde = ($pagina - 1) * $por_pagina;
                    $total_paginas = ceil($total_registro / $por_pagina);

                    $sentence = "SELECT * FROM producto ORDER BY codProducto LIMIT $desde, $por_pagina";
                    $result = $conexion->query($sentence) or die("Error al consultar: " . mysqli_error($conexion));
                    mysqli_close($conexion);

                    while ($rows = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $rows['codproducto'] ?></td>
                            <td><?php echo $rows['nombre'] ?></td>
                            <td><?php echo $rows['descripcion'] ?></td>
                            <td><?php echo $rows['existencia'] ?></td>
                            <td><?php echo $rows['costo'] ?></td>
                            <td><?php echo $rows['precio'] ?></td>
                            <td><?php echo $rows['descuento'] ?></td>
                            <td><?php echo $rows['fechaVencimiento'] ?></td>
                            <td><?php echo $rows['foto'] ?></td>
                            <td><a href="modify_user.php?usr=<?php echo $rows['id'] ?>"><input class="btn-modificar" type="button" value="Modificar"></a></td>
                            <td><a href="../../Controlador/delete_user.php?usr=<?php echo $rows['id'] ?>"><input class="btn-eliminar" type="button" value="Eliminar"></a></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>


                <!--cuadro de producto agregado al inventario-->
                <section>
                    <div class="producto-agregado" id="producto-agregado">
                        <h1>PRODUCTO AGREGADO AL INVENTARIO</h1>
                        <a href="compras.php"><img src="../img/ACEPTAR.png" alt="ACEPTAR" width="20%"></a>
                    </div>
                </section>


                <script>
                    function abrir4() {
                        document.getElementById("producto-agregado").style.display = "block";
                    }
                </script>



    </body>
<?php include '../../includes/footer.php';
} else {
    echo '<script>';
    echo 'alert("Usuario no tiene acceso");';
    echo 'window.location.href= "../../Controlador/exit.php";';
    echo '</script>';
} ?>

    </html>