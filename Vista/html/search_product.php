<?php
include '../../includes/conexion.php';
include '../../includes/header.php';
include '../../includes/nav.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buscar</title>
</head>

<body>

    <?php
    $search = strtolower($_REQUEST['search']);


    ?>
    <!--Botones de usuario-->
    <div class="container-tabla-usuarios">
        <h1>INVENTARIO</h1><br>
        <table class="tabla-usuarios">
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>STOCK DISP.</th>
            <th>PRECIO DE COMPRA</th>
            <th>PRECIO VENTA</th>
            <th>FECHA VENC.</th>
            <th>FOTO</th>

            <?php


            $por_pagina = 10; //numero de registros que se muestran por página

            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }
            //query para paginador
            $sql_register = mysqli_query($conexion, "SELECT COUNT(*) as total_registro FROM producto WHERE codproducto LIKE '%$search%' OR nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR proveedor LIKE '%$search%' OR costo LIKE '%$search%' OR precio LIKE '%$search%' OR cantidad LIKE '%$search%' OR fechaVencimiento LIKE '%$search%' ");
            $result_register = mysqli_fetch_array($sql_register);
            $total_registro = $result_register['total_registro'];

            $desde = ($pagina - 1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $sentence = "SELECT codproducto, nombre, descripcion, proveedor, costo, precio, cantidad, fechaVencimiento, foto FROM producto WHERE codproducto LIKE '%$search%' OR nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR proveedor LIKE '%$search%' OR costo LIKE '%$search%' OR precio LIKE '%$search%' OR cantidad LIKE '%$search%' OR fechaVencimiento LIKE '%$search%' OR foto LIKE '%$search%'  ORDER BY codproducto LIMIT $desde, $por_pagina";
            $result = $conexion->query($sentence) or die("Error al consultar: " . mysqli_error($conexion));
            mysqli_close($conexion);

            while ($rows = $result->fetch_array()) {
                if ($rows['foto'] != 'img_producto.png') {
                    $foto = '../img/uploads/' . $rows['foto'];
                } else {
                    $foto = '../img/uploads/img_producto.png';
                }

            ?>
                <tr>
                    <td><?php echo $rows['codproducto'] ?></td>
                    <td><?php echo $rows['nombre'] ?></td>
                    <td><?php echo $rows['descripcion'] ?></td>
                    <td><?php echo $rows['cantidad'] ?></td>
                    <td><?php echo $rows['costo'] ?></td>
                    <td><?php echo $rows['precio'] ?></td>
                    <td><?php echo $rows['fechaVencimiento'] ?></td>
                    <td><a href="<?php echo $foto; ?>" target="blank"><img src="<?php echo $foto; ?>" alt="<?php echo $data['nombre'] ?>" width="60px"></a></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary add_product" product="<?php echo $data['codproducto']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"><i class="bi bi-bag-plus"></i> AGREGAR PRODUCTO</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">
                                            <h4 class="nameProducto" style="text-transform: uppercase;"></h4><br>
                                            <input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del Producto" required><br><br>
                                            <input type="text" name="precio" id="txtPrecio" placeholder="Precio del Producto" required><br>
                                            <input type="hidden" name="producto_id" id="producto_id" required><br>
                                            <input type="hidden" name="action" value="addProduct" required>

                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cerrar</button>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="alert alert-success alert_add_product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    </div>
    </td>
    <td><a href="modify_product.php?usr=<?php echo $rows['codproducto'] ?>"><i class="bi bi-pencil-square" style="font-size: 2rem; color: #198754;"></i></a></td>
    <td><a href="../../Controlador/delete_product.php?usr=<?php echo $rows['codproducto'] ?>"><i class="bi bi-trash-fill" style="font-size: 2rem; color: #dc3545;"></i></a></td>

    </tr>

<?php
            }

?>
</table><br><br>

<div class="paginador">
    <ul>
        <?php
        if ($pagina != 1) {
        ?>
            <li><a href="?pagina=<?php echo 1; ?>&search=<?php echo $search; ?>">|<< /a>
            </li>
            <li><a href="?pagina=<?php echo $pagina - 1; ?>&search=<?php echo $search; ?>">
                    <<< /a>
            </li>
        <?php
        }
        for ($i = 1; $i <= $total_paginas; $i++) {

            if ($i == $pagina) {
                echo '<li class="pageSelected" >' . $i . '</li>';
            } else {
                echo '<li><a href="?pagina=' . $i . '&search=' . $search . '">' . $i . '</a></li>';
            }
        }
        if ($pagina != $total_paginas) {
        ?>
            <li><a href="?pagina=<?php echo $pagina + 1; ?>&search=<?php echo $search; ?>">>></a></li>
            <li><a href="?pagina=<?php echo $total_paginas ?>&search=<?php echo $search; ?>">>|</a></li>
        <?php } ?>
    </ul>
</div>


<form action="search_product.php" method="GET">
    <label id="buscar" for="buscar">Consultar Base de Datos </label>
    <input type="text" class="control-buscar" name="search" id="busqueda" placeholder="Ingrese término a buscar" value="<?php echo $search; ?>">
    <input class="btn-buscar" type="submit" value="Buscar"><br><br><br>
</form>

<a href="new_user.php"><input class="btn-crear" type="button" value="Crear Usuario"></a>
</div>

</body>


</html>