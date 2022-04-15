<?php
include '../../includes/conexion.php';
include '../../includes/header.php';
include '../../includes/nav.php';
include '../../includes/script.php';
echo '<script type="text/javascript" src="../js/functions.js"></script>';
if ($_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Vendedor') {

    if (!empty($_POST)) {

        $alert = '';
        if (empty($_POST['proveedor']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['costo']) || $_POST['costo'] <= 0 || empty($_POST['precio']) || $_POST['precio'] <= 0) {
            echo '<script>
            errorData()
            </script>';
        } else {

            $codproducto = $_REQUEST['usr'];
            $proveedor = $_POST['proveedor'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $costo = $_POST['costo'];
            $precio = $_POST['precio'];
            $imgProducto = $_POST['foto_actual'];
            $imgRemove = $_POST['foto_remove'];
            $fechaVence = $_POST['fechaVence'];


            $foto = $_FILES['foto'];
            $nombre_foto = $foto['name'];
            $type = $foto['type'];
            $url_temp = $foto['tmp_name'];
            $upd = '';

            if ($nombre_foto != '') {
                $destino = '/opt/lampp/htdocs/sifco_html/Vista/img/uploads/';
                $img_nombre = 'img_' . md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre . '.jpg';
                $src = $destino . $imgProducto;
            }else{
                if ($_POST['foto_actual'] != $_POST['foto_remove']) {
                    $imgProducto = 'img_producto.png';
                }
            }
            $query_update = mysqli_query($conexion, "UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion', proveedor = $proveedor, costo = $costo, precio = $precio, fechaVencimiento = '$fechaVence', foto = '$imgProducto'
            WHERE codproducto = $codproducto ");

            if ($query_update) {

                if (($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])) {
                    unlink('/opt/lampp/htdocs/sifco_html/Vista/img/uploads/'.$_POST['foto_actual']);
                }
                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp, $src);
                };
                echo '<script>
                editedProduct()       
                </script>';
            } else {
                echo $proveedor;
                echo '<script>
                errorProduct()        
                </script>';
            }
        }
    }
    if (empty($_GET['usr'])) {
        header('Location: inventarios.php');
    } else {
        $id_producto = $_REQUEST['usr'];
        if (!is_numeric($id_producto)) {
            header('Location: inventarios.php');
        }
        $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.nombre, p.descripcion, p.costo, p.precio, p.fechaVencimiento, pr.proveedor, pr.codproveedor, p.foto FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto AND p.estatus = 1");
        $result_producto = mysqli_num_rows($query_producto);

        $foto = '';
        $classRemove = 'notBlock';

        if ($result_producto > 0) {
            $data_producto = mysqli_fetch_assoc($query_producto);

            if ($data_producto['foto'] != 'img_producto.png') {
                $classRemove = '';
                $foto = '<img id="img" src="../img/uploads/' . $data_producto['foto'] . '" alt="Producto">';
            }
        } else {
            header('Location: inventarios.php');
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Producto</title>
    </head>

    <body>
        <div class="agregar-usuario" id="modificar-usuario">
            <form action="" class="inventario" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
                <input type="hidden" name="foto_actual" id="foto_actual" value="<?php echo $data_producto['foto']; ?>">
                <input type="hidden" name="foto_remove" id="foto_remove" value="<?php echo $data_producto['foto']; ?>">



                <h3> EDITAR PRODUCTO</h3>
                <div class="mb-4">
                    <label for="proveedor" class="form-label mt-2">Proveedor</label>
                    <!-- query para consultar la lista de proveedores -->
                    <?php

                    $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor");
                    $result_proveedor = mysqli_num_rows($query_proveedor);

                    ?>
                    <select name="proveedor" id="proveedor" class="form-select notItemOne">
                        <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>

                        <?php

                        if ($result_proveedor > 0) {
                            while ($result_proveedor = mysqli_fetch_array($query_proveedor)) {
                        ?>

                                <option id="proveedor" name="proveedor" value="<?php echo $result_proveedor['codproveedor']; ?>"><?php echo $result_proveedor['proveedor']; ?></option>

                        <?php
                            }
                        } ?>
                    </select><br>
                    <a href="new_proveedor.php" target="_blank">
                        <button type="button" class="btn btn-primary">Nuevo Proveedor</button>
                    </a><br>
                    <label for="nombre" class="form-label mt-3">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" class="form-control" value="<?php echo $data_producto['nombre'] ?>" required>

                    <label for="descripcion" class="form-label mt-3">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del Producto" class="form-control" value="<?php echo $data_producto['descripcion'] ?>" required>

                    <label for="costo" class="form-label mt-3">Costo</label>
                    <input type="number" name="costo" id="costo" placeholder="Costo del Producto" class="form-control" value="<?php echo $data_producto['costo'] ?>" required>

                    <label for="precio" class="form-label mt-3">Precio</label>
                    <input type="number" name="precio" id="precio" placeholder="Precio del producto" class="form-control" value="<?php echo $data_producto['precio'] ?>" required>

                    <label for="fechaVence" class="form-label mt-3">Fecha de Vencimiento</label>
                    <input type="date" name="fechaVence" id="fechaVence" class="form-control" value="<?php echo $data_producto['fechaVencimiento'] ?>" required>


                    <div class="photo">
                        <label for="foto">Foto</label>
                        <div class="prevPhoto">
                            <span class="delPhoto <?php echo $classRemove; ?>">X</span>
                            <label for="foto"></label>
                            <?php echo $foto; ?>

                        </div>
                        <div class="upimg">
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>

                </div>

                <div class="d-flex justify-content-between">
                    <input class="btn btn-primary" type="submit" value="MODIFICAR">
                    <a href="inventarios.php"><input class="btn btn-danger" type="button" value="CANCELAR"></a>
                </div>

            </form>
        </div>

    </body>

    </html>
<?php } ?>